<?php
/**
 * @package    Observers
 * @author     Tiago Teixeira de Sousa <tiagoteixeira2214@gmail.com>
 * @date       27/04/2021 01:27:44
 */

declare(strict_types=1);

namespace App\Observers;

use App\Models\PlayersListDay;

class PlayersListDayObserver
{

    /**
     * Handle the playersListDay "creating" event.
     *
     * @param  \App\Models\PlayersListDay  $playersListDay
     * @return void
     */
    public function creating(PlayersListDay $playersListDay)
    {

        $playersListDay->user_creator_id = \Auth::id();
        //$playersListDay->user_updater_id = \Auth::id();
    }


    /**
     * Handle the playersListDay "updating" event.
     *
     * @param  \App\Models\PlayersListDay  $playersListDay
     * @return void
     */
    public function updating(PlayersListDay $playersListDay)
    {

        $playersListDay->user_updater_id = \Auth::id();
    }


    /**
     * Handle the playersListDay "deleting" event.
     *
     * @param  \App\Models\PlayersListDay  $playersListDay
     * @return void
     */
    public function deleting(PlayersListDay $playersListDay)
    {

        $playersListDay->user_eraser_id = \Auth::id();
        $playersListDay->timestamps = false;
        $playersListDay->save();
    }
}
