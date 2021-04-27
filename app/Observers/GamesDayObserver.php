<?php
/**
 * @package    Observers
 * @author     Tiago Teixeira de Sousa <tiagoteixeira2214@gmail.com>
 * @date       09/03/2021 02:54:27
 */

declare(strict_types=1);

namespace App\Observers;

use App\Models\GamesDay;

class GamesDayObserver
{

    /**
     * Handle the gamesDay "creating" event.
     *
     * @param  \App\Models\GamesDay  $gamesDay
     * @return void
     */
    public function creating(GamesDay $gamesDay)
    {

        $gamesDay->user_creator_id = \Auth::id();
        //$gamesDay->user_updater_id = \Auth::id();
    }


    /**
     * Handle the gamesDay "updating" event.
     *
     * @param  \App\Models\GamesDay  $gamesDay
     * @return void
     */
    public function updating(GamesDay $gamesDay)
    {

        $gamesDay->user_updater_id = \Auth::id();
    }


    /**
     * Handle the gamesDay "deleting" event.
     *
     * @param  \App\Models\GamesDay  $gamesDay
     * @return void
     */
    public function deleting(GamesDay $gamesDay)
    {

        $gamesDay->user_eraser_id = \Auth::id();
        $gamesDay->timestamps = false;
        $gamesDay->save();
    }
}
