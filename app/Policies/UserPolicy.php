<?php
/**
 * @package    Controller
 * @author     Tiago Teixeira de Sousa <tiagoteixeira2214@gmail.com>
 * @date       05/02/2021 21:38:30
 */

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        return $user->is_dev;
    }

    /**
     * Determine whether the user can view any user.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user): bool
    {

        return true;
    }

    /**
     * Determine whether the user can create user.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user): bool
    {

        return true;
    }

    /**
     * Determine whether the user can update the user.
     *
     * @param User $user
     * @param User $user
     * @return mixed
     */
    public function update(User $user, User $user1): bool
    {

        return true;
    }

    /**
     * Determine whether the user can delete the user.
     *
     * @param User $user
     * @param User $user
     * @return mixed
     */
    public function delete(User $user, User $user1): bool
    {

        return true;
    }
}
