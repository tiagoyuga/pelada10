<?php
/**
 * @package    Services
 * @author     Tiago Teixeira de Sousa <tiagoteixeira2214@gmail.com>
 * @date       05/03/2021 03:01:12
 */

declare(strict_types=1);

namespace App\Services;

use App\Models\EventsUser;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class EventsUserService
{

    private function buildQuery(): Builder
    {

        $query = EventsUser::query();

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

    public function all(): Collection
    {

        return $this->buildQuery()->get();
    }

    public function find(int $id): ?EventsUser
    {

        //return Cache::remember('EventsUser_find_' . $id, config('cache.cache_time'), function () use ($id) {
        return EventsUser::find($id);
        //});
    }

    public function create(array $data): EventsUser
    {

        return DB::transaction(function () use ($data) {

            $model = new EventsUser();
            $model->fill($data);
            #$model->user_creator_id = \Auth::id();
            #$model->user_updater_id = \Auth::id();
            $model->save();

            return $model;
        });
    }

    public function update(array $data, EventsUser $model): EventsUser
    {

        $model->fill($data);
        #$model->user_updater_id = \Auth::id();
        $model->save();

        return $model;
    }

    public function delete(EventsUser $model): ?bool
    {
        #$model->user_eraser_id = \Auth::id();
        $model->save();

        return $model->delete();
    }

    public function lists(): array
    {
        //return Cache::remember('EventsUser_lists', config('cache.cache_time'), function () {

        return EventsUser::orderBy('name')
            ->pluck('name', 'id')
            ->toArray();
        //});
    }

    public function listByUser($user_id): Collection
    {
        //return Cache::remember('EventsUser_lists', config('cache.cache_time'), function () {

        return EventsUser::select(['*'])
            ->whereUserId($user_id)
            ->whereActive('1')
            ->get();
        //});
    }
}
