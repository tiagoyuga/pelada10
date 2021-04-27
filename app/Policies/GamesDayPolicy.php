<?php
/**
 * @package    Controller
 * @author     Tiago Teixeira de Sousa <tiagoteixeira2214@gmail.com>
 * @date       09/03/2021 02:54:27
 */

declare(strict_types=1);

namespace App\Policies;

use App\Models\GamesDay;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GamesDayPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        #return $user->is_dev;
        if ($user->is_dev) return true;
    }

    /**
     * Determine whether the user can view any gamesDay.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {

        return true;
    }

    /**
     * Determine whether the user can create gamesDay.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {

        return true;
    }

    /**
     * Determine whether the user can update the gamesDay.
     *
     * @param User $user
     * @param GamesDay $gamesDay
     * @return mixed
     */
    public function update(User $user, GamesDay $gamesDay)
    {

        return true;
    }

    /**
     * Determine whether the user can delete the gamesDay.
     *
     * @param User $user
     * @param GamesDay $gamesDay
     * @return mixed
     */
    public function delete(User $user, GamesDay $gamesDay)
    {

        return true;
    }
}
