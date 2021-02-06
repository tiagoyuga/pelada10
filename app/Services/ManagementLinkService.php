<?php
/**
 * @package    Services
 * @author     Tiago Teixeira de Sousa <tiagoteixeira2214@gmail.com>
 * @date       15/07/2019 20:48:19
 */

declare(strict_types=1);

namespace App\Services;

use App\Models\ManagementLink;
use App\Models\SharedLink;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ManagementLinkService
{

    public function paginate(int $limit): LengthAwarePaginator
    {

        return $this->buildQuery()
            ->with('ManagementIndicationCategory', 'partner')
            ->paginate($limit);
    }

    private function buildQuery(): Builder
    {

        $query = ManagementLink::query();

        $query->when(request('id'), function ($query, $id) {

            return $query->whereId($id);
        });

        $query->when(request('search'), function ($query, $search) {

            return $query->where('name', 'LIKE', '%' . $search . '%');
            //->orWhere('uid', $search);
        });

        return $query;
    }

    public function all(): Collection
    {

        return $this->buildQuery()->get();
    }

    public function find(int $id): ?ManagementLink
    {

        return ManagementLink::find($id);
    }

    public function create(array $data): ManagementLink
    {

        return DB::transaction(function () use ($data) {

            $model = new ManagementLink();
            $model->fill($data);
            #$model->user_creator_id = \Auth::id();
            #$model->user_updater_id = \Auth::id();
            $model->save();

            return $model;
        });
    }

    public function update(array $data, ManagementLink $model): ManagementLink
    {

        $model->fill($data);
        #$model->user_updater_id = \Auth::id();
        $model->save();

        return $model;
    }

    public function delete(ManagementLink $model): ?bool
    {

        $model->save();

        return $model->delete();
    }

    public function lists(): array
    {
        //return Cache::remember('ManagementIndication_lists', config('cache.cache_time'), function () {

        return ManagementLink::orderBy('name')
            ->pluck('name', 'id')
            ->toArray();
        //});
    }

    public function getCode(User $user)
    {

        if (empty($user->indication_url)) {

            $login = config("bitly.login");
            $api_key = config("bitly.api_key");
            $bit_ly_url = config("bitly.url");

            $invalidHash = true;

            do {

                $hash = randHash(6);

                if (!User::whereIndicationCode($hash)->first()) {

                    $invalidHash = false;
                }

            } while ($invalidHash);

            $user->indication_code = $hash;

            $internal_url = route("front.showRegistrationForm", ['indication_code' => $user->indication_code]);
            $api_url = $bit_ly_url . urlencode($internal_url) . '&login=' . $login . '&apiKey=' . $api_key . '&format=json';

            try {

                $url = json_decode(file_get_contents($api_url), true);

                $url = isset($url['results'][$internal_url]['shortUrl']) ? $url['results'][$internal_url]['shortUrl'] : $internal_url;

            } catch (Exception $exception) {

                $url = $internal_url;
            }

            $user->indication_url = $url;
            $user->save();
        }

        return $user->indication_url;
    }

    public function managementLink(User $owner_user, User $user = null): ManagementLink
    {

        return DB::transaction(function () use ($owner_user, $user) {

            $model = ManagementLink::create([
                "owner_user_id" => $owner_user->id,
                "user_id" => ($user ? $user->id : null),
            ]);

            return $model;
        });
    }

    public function listIndications($limit = 20)
    {

        $ownersUsersIndications = ManagementLink::select(\DB::Raw("DISTINCT owner_user_id"))
            ->join("users", "users.id", "=", "management_links.owner_user_id");

        if (request()->get('start_date')) {

            $startDate = Carbon::createFromFormat('d/m/Y', request()->get('start_date'))->format('Y-m-d');
            $ownersUsersIndications->where("management_links.created_at", ">=", $startDate);
        }

        if (request()->get('end_date')) {

            $endDate = Carbon::createFromFormat('d/m/Y', request()->get('end_date'))->format('Y-m-d');
            $ownersUsersIndications->where("management_links.created_at", "<=", $endDate);
        }

        if (request()->get('link')) {

            $ownersUsersIndications->where("users.indication_url", "=", request()->get('link'));
        }

        if (request()->get('code')) {

            $ownersUsersIndications->where("users.indication_code", "=", request()->get('code'));
        }

        if (request()->get('user_id')) {

            $ownersUsersIndications->where("users.id", "=", request()->get('user_id'));
        }

        $ownersUsersIndications = $ownersUsersIndications->paginate($limit);

        foreach ($ownersUsersIndications as $indications) {

            $managementLink = ManagementLink::select("users.id as user_id",
                \DB::Raw("COUNT(management_links.id) as totalViews"),
                \DB::Raw("COUNT(user_id) as totalRegisters"),
                "users.name",
                "users.indication_url",
                "users.indication_code")
                ->join("users", "users.id", "=", "management_links.owner_user_id")
                ->where("owner_user_id", $indications->owner_user_id)->first();

            $indications->management = $managementLink;
        }

        return $ownersUsersIndications;
    }
}
