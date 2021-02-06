<?php
/**
 * @package    Observers
 * @author     Rupert Brasil Lustosa <rupertlustosa@gmail.com>
 * @date       05/02/2021 21:38:30
 */

declare(strict_types=1);

namespace App\Observers;

use App\Models\User;

class UserObserver
{

    /**
     * Handle the user "creating" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function creating(User $user)
    {

        $user->user_creator_id = \Auth::id();
        //$user->user_updater_id = \Auth::id();
    }


    /**
     * Handle the user "updating" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updating(User $user)
    {

        $user->user_updater_id = \Auth::id();
    }


    /**
     * Handle the user "deleting" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleting(User $user)
    {

        $user->user_eraser_id = \Auth::id();
        $user->timestamps = false;
        $user->save();
    }
}
