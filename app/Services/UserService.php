<?php
/**
 * @package    Services
 * @author     Tiago Teixeira de Sousa <tiagoteixeira2214@gmail.com>
 * @date       05/02/2021 21:38:30
 */

declare(strict_types=1);

namespace App\Services;

use App\Models\Event;
use App\Models\EventsUser;
use App\Models\SocialAccount;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class UserService
{

    private function buildQuery(): Builder
    {

        $query = User::query();

        $query->when(request('id'), function ($query, $id) {

            return $query->whereId($id);
        });

        $query->when(request('search'), function ($query, $search) {

            return $query->where('id', 'LIKE', '%' . $search . '%');
        });

        return $query;
    }

    public function paginate(int $limit): LengthAwarePaginator
    {

        return $this->buildQuery()->paginate($limit);
    }

    public function getLinkedUsers(int $limit): LengthAwarePaginator
    {
        $data = $this->buildQuery();

        $data = $data->join('events_user', 'events_user.user_id', 'users.id')
            ->where('events_user.event_id', Auth::user()->selectedEvent->id);

        return $data->paginate($limit);
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

            $model = new User();
            $model->fill($data);
            #$model->user_creator_id = \Auth::id();
            #$model->user_updater_id = \Auth::id();

            if (!empty($data["password"])) {
                $model->password = Hash::make($data["password"]);
            }

            $model->save();

            return $model;
        });
    }

    public function createLinkedUser(array $data): User
    {
        return DB::transaction(function () use ($data) {

            if(isset($data['birth']) && !empty($data['birth'])) {
                $data['birth'] = Carbon::createFromFormat('d/m/Y', $data['birth'])->format('Y-m-d');
            }

            $model = new User();
            $model->fill($data);
            $model->user_creator_id = Auth::id();
            $model->user_updater_id = Auth::id();
            $model->is_temporary = 1;
            $model->save();

            #vincular ao evento
            $userEvent = new EventsUser();
            $userEvent->user_id = $model->id;
            $userEvent->event_id = Auth::user()->selectedEvent->id;
            $userEvent->save();

            return $model;
        });
    }

    public function update(array $data, User $model): User
    {
        if(isset($data['birth']) && !empty($data['birth'])) {
            $data['birth'] = Carbon::parse($data['birth'])->format('Y-d-m');
        }

        $model->fill($data);

        #$model->user_updater_id = \Auth::id();
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
            #'user' => new UserResource($user),
            'user' => collect($user),
            'token' => $token,
            'generic_error' => null,
        ];
    }

    public function changeSelectedEvent(Event $event)
    {

        return Auth::user()->update([
            'selected_event' => $event->id
        ]);
    }
}
