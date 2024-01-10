<?php
/**
 * @package    Controller
 * @author     Tiago Teixeira de Sousa <tiagoteixeira2214@gmail.com>
 * @date       27/04/2021 01:27:44
 */

declare(strict_types=1);

namespace App\Policies;

use App\Models\PlayersListDay;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlayersListDayPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        #return $user->is_dev;
        if ($user->is_dev) return true;
    }

    /**
     * Determine whether the user can view any playersListDay.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {

        return true;
    }

    /**
     * Determine whether the user can create playersListDay.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {

        return true;
    }

    /**
     * Determine whether the user can update the playersListDay.
     *
     * @param User $user
     * @param PlayersListDay $playersListDay
     * @return mixed
     */
    public function update(User $user, PlayersListDay $playersListDay)
    {

        return true;
    }

    /**
     * Determine whether the user can delete the playersListDay.
     *
     * @param User $user
     * @param PlayersListDay $playersListDay
     * @return mixed
     */
    public function delete(User $user, PlayersListDay $playersListDay)
    {

        return true;
    }
}
