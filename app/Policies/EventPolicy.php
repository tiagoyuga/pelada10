<?php
/**
 * @package    Controller
 * @author     Tiago Teixeira de Sousa <tiagoteixeira2214@gmail.com>
 * @date       27/02/2021 03:15:02
 */

declare(strict_types=1);

namespace App\Policies;

use App\Models\Event;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->is_dev) return true;
    }

    /**
     * Determine whether the user can view any event.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {

        return true;
    }

    /**
     * Determine whether the user can create event.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {

        return true;
    }

    /**
     * Determine whether the user can update the event.
     *
     * @param User $user
     * @param Event $event
     * @return mixed
     */
    public function update(User $user, Event $event)
    {

        return true;
    }

    /**
     * Determine whether the user can delete the event.
     *
     * @param User $user
     * @param Event $event
     * @return mixed
     */
    public function delete(User $user, Event $event)
    {

        return true;
    }
}
