<?php
/**
 * @package    Observers
 * @author     Tiago Teixeira de Sousa <tiagoteixeira2214@gmail.com>
 * @date       27/02/2021 03:15:02
 */

declare(strict_types=1);

namespace App\Observers;

use App\Models\Event;

class EventObserver
{

    /**
     * Handle the event "creating" event.
     *
     * @param  \App\Models\Event  $event
     * @return void
     */
    public function creating(Event $event)
    {

        $event->user_creator_id = \Auth::id();
        //$event->user_updater_id = \Auth::id();
    }


    /**
     * Handle the event "updating" event.
     *
     * @param  \App\Models\Event  $event
     * @return void
     */
    public function updating(Event $event)
    {

        $event->user_updater_id = \Auth::id();
    }


    /**
     * Handle the event "deleting" event.
     *
     * @param  \App\Models\Event  $event
     * @return void
     */
    public function deleting(Event $event)
    {

        $event->user_eraser_id = \Auth::id();
        $event->timestamps = false;
        $event->save();
    }
}
