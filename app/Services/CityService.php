<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\City;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class CityService
{

    public function paginate(int $limit): LengthAwarePaginator
    {

        return $this->buildQuery()->orderBy('id', "desc")->paginate($limit);
    }

    private function buildQuery(): Builder
    {

        $query = City::query();


        if (request('city')) {
            $query->when("city", function ($query) {
                return $query->where('city', 'LIKE', '%' . request('city') . '%');
            });

        }


        return $query;
    }

    public function all(): Collection
    {

        return $this->buildQuery()->get();
    }

    public function find(int $id): ?City
    {

        return City::find($id);
    }


    public function lists(): array
    {
        //return Cache::remember('City_lists', config('cache.cache_time'), function () {

        return City::orderBy('city')
            ->pluck('city', 'id', 'state_id')->toArray();
        //});
    }


    public function findList(): Collection
    {

        //$cacheKey = RHelper::generateCacheKey();
        //return Cache::tags('cities')->remember('cities_findList_' . $cacheKey, config('cache.cache_time'), function () {

        $query = City::query();

        $query->when(request('search'), function ($query, $search) {

            return $query->where('city', 'LIKE', '%' . $search . '%');
        });

        return $query->join('states', 'states.id', '=', 'cities.state_id')
            ->get(['cities.id', 'cities.city', 'states.state']);
        //});
    }

}
