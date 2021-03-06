<?php
/**
 * @package    Controller
 * @author     Tiago Teixeira de Sousa <tiagoteixeira2214@gmail.com>
 * @date       27/02/2021 03:49:31
 */

declare(strict_types=1);

namespace App\Policies;

use App\Models\Configuration;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class ConfigurationPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->is_dev) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any configuration.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {

        return false;
    }

    /**
     * Determine whether the user can create configuration.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {

        return false;
    }

    /**
     * Determine whether the user can update the configuration.
     *
     * @param User $user
     * @param Configuration $configuration
     * @return mixed
     */
    public function update(User $user, Configuration $configuration)
    {
        $isEventAdmin = in_array($configuration->event_id, $user->eventsUser->whereIsAdmin('1')->pluck('event_id')->toArray());
        return ($user->selected_event == $configuration->event_id && $isEventAdmin);

        //$events = $user->eventsUser->whereIsAdmin('1')->pluck('event_id')->toArray();
        //return (in_array($configuration->event_id, $events));
        #return true;
    }

    /**
     * Determine whether the user can delete the configuration.
     *
     * @param User $user
     * @param Configuration $configuration
     * @return mixed
     */
    public function delete(User $user, Configuration $configuration)
    {

        return false;
    }
}
