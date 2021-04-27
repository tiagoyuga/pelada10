<?php
/**
 * @package    Services
 * @author     Tiago Teixeira de Sousa <tiagoteixeira2214@gmail.com>
 * @date       09/03/2021 02:54:27
 */

declare(strict_types=1);

namespace App\Services;

use App\Models\GamesDay;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GamesDayService
{

    private function buildQuery(): Builder
    {

        $query = GamesDay::query();

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

    public function find(int $id): ?GamesDay
    {
        return GamesDay::find($id);
    }

    public function create(array $data): GamesDay
    {
        return DB::transaction(function () use ($data) {

            $data['game_day'] = Carbon::parse($data['game_day'])->format('Y-m-d')." ".$data['hour'].":00";
            $data['event_id'] = Auth::user()->selected_event;

            $model = new GamesDay();
            $model->fill($data);
            #$model->user_creator_id = \Auth::id();
            #$model->user_updater_id = \Auth::id();
            $model->save();

            return $model;
        });
    }

    public function update(array $data, GamesDay $model): GamesDay
    {

        $model->fill($data);
        #$model->user_updater_id = \Auth::id();
        $model->save();

        return $model;
    }

    public function delete(GamesDay $model): ?bool
    {
        #$model->user_eraser_id = \Auth::id();
        $model->save();

        return $model->delete();
    }

    public function lists(): array
    {
        return GamesDay::orderBy('name')
            ->pluck('name', 'id')
            ->toArray();

    }
}
