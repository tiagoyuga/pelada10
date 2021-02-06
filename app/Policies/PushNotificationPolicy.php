<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;
use App\TypeOfUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class PushNotificationPolicy
{

    use HandlesAuthorization;

    public function before($user, $ability)
    {
        $is_admin = (in_array(TypeOfUser::ADMIN, $user->types->pluck('id')->toArray()));
        return ($user->is_dev || $is_admin);
    }

    /**
     * Determine whether the user can view any faq.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {

        #return ($user->is_dev);
        return true;
    }

    /**
     * Determine whether the user can create faq.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {

        /*$userHasAnyLevel = userHasAnyLevel([TypeOfUser::ADMIN], $user);
        $userIsDev = $user->is_dev;

        return $userHasAnyLevel || $userIsDev;*/

        #return ($user->is_dev);
        return true;
    }

    /**
     * Determine whether the user can update the faq.
     *
     * @param User $user
     * @param Faq $faq
     * @return mixed
     */
    public function update(User $user, Faq $faq)
    {

        /*$userHasAnyLevel = userHasAnyLevel([TypeOfUser::ADMIN], $user);
        $userIsDev = $user->is_dev;

        return $userHasAnyLevel || $userIsDev;*/
        return true;
    }

    /**
     * Determine whether the user can delete the faq.
     *
     * @param User $user
     * @param Faq $faq
     * @return mixed
     */
    public function delete(User $user, Faq $faq)
    {

        /*$userHasAnyLevel = userHasAnyLevel([TypeOfUser::ADMIN], $user);
        $userIsDev = $user->is_dev;

        return $userHasAnyLevel || $userIsDev;*/
        return true;
    }
}
