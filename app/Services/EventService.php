<?php
/**
 * @package    Services
 * @author     Tiago Teixeira de Sousa <tiagoteixeira2214@gmail.com>
 * @date       27/02/2021 03:15:02
 */

declare(strict_types=1);

namespace App\Services;

use App\Models\Configuration;
use App\Models\Event;
use App\Models\EventsUser;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventService
{

    private function buildQuery(): Builder
    {

        $query = Event::query();

        $query->when(request('id'), function ($query, $id) {

            return $query->whereId($id);
        });

        $query->when(request('search'), function ($query, $search) {

            return $query->where('id', 'LIKE', '%' . $search . '%');
        });

        //lista somente os eventos que o usuário esta vinculado
        $query->join('events_user', 'events_user.event_id', '=', 'events.id')
            ->where('events_user.user_id', '=', Auth::id());

        return $query->select(['events.*']);
    }

    public function paginate(int $limit): LengthAwarePaginator
    {

        return $this->buildQuery()->paginate($limit);
    }

    public function all(): Collection
    {

        return $this->buildQuery()->get();
    }

    public function find(int $id): ?Event
    {

        //return Cache::remember('Event_find_' . $id, config('cache.cache_time'), function () use ($id) {
        return Event::find($id);
        //});
    }

    public function create(array $data): Event
    {
        return DB::transaction(function () use ($data) {

            $model = new Event();
            $model->fill($data);
            #$model->user_creator_id = \Auth::id();
            #$model->user_updater_id = \Auth::id();
            $model->save();

            EventsUser::create([
                'user_id' => Auth::id(),
                'event_id' => $model->id,
                'is_admin' => '1',
                'owner_id' => Auth::id(),
                'active' => '1',
            ]);

            Configuration::create([
                'event_id' => $model->id,
                'players' => '5',
                'game_duration' => '10',
            ]);

            Auth::user()->update([
                'selected_event' => $model->id
            ]);

            return $model;
        });
    }

    public function update(array $data, Event $model): Event
    {

        $model->fill($data);
        #$model->user_updater_id = \Auth::id();
        $model->save();

        return $model;
    }

    public function delete(Event $model): ?bool
    {
        #$model->user_eraser_id = \Auth::id();
        $model->save();

        return $model->delete();
    }

    public function lists(): array
    {
        //return Cache::remember('Event_lists', config('cache.cache_time'), function () {

        return Event::orderBy('name')
            ->pluck('name', 'id')
            ->toArray();
        //});
    }
}
