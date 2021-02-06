<?php
/**
 * @package    Services
 * @author     Tiago Teixeira de Sousa <tiagoteixeira2214@gmail.com>
 * @date       09/12/2019 10:25:33
 */

declare(strict_types=1);

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Models\Address;
use App\Models\SocialAccount;
use App\Models\Type;
use App\Models\User;
use App\Traits\ImageCrop;
use App\TypeOfUser;
use Auth;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class BKP_UserService
{

    use ImageCrop;

    public function paginate(int $limit): LengthAwarePaginator
    {

        return $this->buildQuery()->paginate($limit);
    }

    private function buildQuery(): Builder
    {

        $query = User::query();

        $query->when(request('id'), function ($query, $id) {

            return $query->whereId($id);
        });

        if (request('name')) {
            $query->when("name", function ($query) {
                return $query->where('name', 'LIKE', '%' . request('name') . '%');
            });
        }


        if (request('email')) {
            $query->when("email", function ($query) {
                return $query->where('email', '=', request('email'));
            });
        }

        if (request('type')) {
            $query->whereHas("types", function ($query) {
                return $query->where('types.id', '=', request('type'));
            });
        }

        return $query;
    }

    public function all(): Collection
    {

        return $this->buildQuery()->get();
    }

    public function find(int $id): ?User
    {

        //return Cache::remember('User_find_' . $id, config('cache.cache_time'), function () use ($id) {
        return User::find($id);
        //});
    }

    public function create(array $data): User
    {
        return DB::transaction(function () use ($data) {

            #$data['image'] = uploadWithCrop('image', 'administrators');

            $model = new User();
            $model->fill($data);

            #$model->user_creator_id = Auth::id();
            #$model->user_updater_id = Auth::id();

            if (!empty($data["password"])) {
                $model->password = Hash::make($data["password"]);
            }

            $model->save();

            return $model;
        });
    }

    public function update(array $data, User $model): User
    {
        if (!empty($data["password"])) {
            $model->password = Hash::make($data["password"]);
        }

        $image = uploadWithCrop('image', 'web');

        if ($image !== null) {

            $data['image'] = $image;
        } elseif (request('delete_image')) {

            $data['image'] = null;
        }

        $model->fill($data);
        #$model->user_updater_id = Auth::id();
        $model->save();

        return $model;
    }

    public function delete(User $model): ?bool
    {
        #$model->user_eraser_id = \Auth::id();
        $model->save();

        return $model->delete();
    }

    public function lists(): array
    {
        //return Cache::remember('User_lists', config('cache.cache_time'), function () {

        return User::orderBy('name')
            ->pluck('name', 'id')
            ->toArray();
        //});
    }

    public function profileUpdate(array $data, User $model): User
    {

        if (!empty($data["password"])) {
            $model->password = Hash::make($data["password"]);
        }

        $image = uploadWithCrop('image', 'users');

        if ($image !== null) {
            $data['image'] = $image;
        } elseif (request('delete_image')) {

            $data['image'] = null;
        }

        $model->fill($data);
        $model->save();

        return $model;
    }

    /**
     * @param $token
     * @param $provider [facebook, google]
     * @return
     * @throws \ErrorException
     */
    public function getAuthSocialData($token, $provider) #: Socialite
    {
        if (!$token) {
            throw new \ErrorException('token não informado', 401);
        }

        $socialAuthUserDetails = Socialite::driver($provider)->userFromToken($token);

        if (!$socialAuthUserDetails) {
            throw new \ErrorException('Dados não encontrados', 404);
        }

        return $socialAuthUserDetails;
    }

    /**
     * @param $provider
     * @return User
     */
    public function findOrNewSocialUser($provider): User
    {
        $userSocialData = Socialite::driver($provider)->user();

        $socialAccount = SocialAccount::where('provider_user_id', '=', $userSocialData->getId())->first();

        if ($socialAccount) {

            $user = $this->find((int)$socialAccount->user_id);

        } else {

            $user = User::where('email', '=', $userSocialData->getEmail())->first();

            if (!$user) {

                $user = $this->create([
                    'name' => $userSocialData->getName(),
                    'email' => $userSocialData->getEmail(),
                ]);
            }

            SocialAccount::create([
                'user_id' => $user->id,
                'provider_user_id' => $userSocialData->getId(),
                'provider' => $provider,
                'picture' => $userSocialData->getAvatar(),
            ]);
        }

        return $user;
    }

    public function authenticateUserInApi($user)
    {
        Auth::loginUsingId($user->id);

        $user = Auth::user();

        $token = $user->createToken('AppName')->accessToken;

        #return response()->json([
        return [
            'user' => new UserResource($user),
            'token' => $token,
            'generic_error' => null,
        ];
    }

    /**
     * @param $data
     * @return mixed
     */
    public function findWhere($data)
    {
        return User::where($data)->get();
    }

    public function findList($filter_attendant = false): Collection
    {

        $query = User::query();

        $query->when(request('search'), function ($query, $search) {

            return $query->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%');
        });

        return $query->take(30)
            ->get(['users.id', 'users.name']);
    }
}
