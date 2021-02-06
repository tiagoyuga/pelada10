<?php
/**
 * @package    Services
 * @author     Tiago Teixeira de Sousa <tiagoteixeira2214@gmail.com>
 * @date       06/01/2020 15:31:20
 */

declare(strict_types=1);

namespace App\Services;

use App\Models\SocialAccount;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class SocialAccountService
{

    private function buildQuery(): Builder
    {

        $query = SocialAccount::query();

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

    public function find(int $id): ?SocialAccount
    {

        //return Cache::remember('SocialAccount_find_' . $id, config('cache.cache_time'), function () use ($id) {
        return SocialAccount::find($id);
        //});
    }

    public function create(array $data): SocialAccount
    {

        return DB::transaction(function () use ($data) {

            $model = new SocialAccount();
            $model->fill($data);
            #$model->user_creator_id = \Auth::id();
            #$model->user_updater_id = \Auth::id();
            $model->save();

            return $model;
        });
    }

    public function update(array $data, SocialAccount $model): SocialAccount
    {

        $model->fill($data);
        #$model->user_updater_id = \Auth::id();
        $model->save();

        return $model;
    }

    public function delete(SocialAccount $model): ?bool
    {
        #$model->user_eraser_id = \Auth::id();
        $model->save();

        return $model->delete();
    }

    public function lists(): array
    {
        //return Cache::remember('SocialAccount_lists', config('cache.cache_time'), function () {

        return SocialAccount::orderBy('name')
            ->pluck('name', 'id')
            ->toArray();
        //});
    }
}
