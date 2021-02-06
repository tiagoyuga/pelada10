<?php
/**
 * @package    Controller
 * @author     Tiago Teixeira de Sousa <tiagoteixeira2214@gmail.com>
 * @date       14/08/2019 21:23:02
 */

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;
use App\TypeOfUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class ManagementLinkPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any managementLink.
     *
     * @param User $user
     * @return boolean
     */
    public function viewAny(User $user)
    {

        /*$userHasAnyLevel = userHasAnyLevel([TypeOfUser::ADMIN], $user);
        $userIsDev = $user->is_dev;

        return $userHasAnyLevel || $userIsDev;*/

        #return ($user->is_dev);

        $is_admin = (in_array(TypeOfUser::ADMIN, $user->types->pluck('id')->toArray()));
        return ($user->is_dev || $is_admin);
    }
}
