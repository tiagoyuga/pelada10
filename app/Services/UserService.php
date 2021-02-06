<?php
/**
 * @package    Services
 * @author     Rupert Brasil Lustosa <rupertlustosa@gmail.com>
 * @date       05/02/2021 21:38:30
 */

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

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
            $model->save();

            return $model;
        });
    }

    public function update(array $data, User $model): User
    {

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
}
