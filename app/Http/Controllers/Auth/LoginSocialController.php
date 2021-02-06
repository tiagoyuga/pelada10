<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


class LoginSocialController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirect($provider)
    {

        $this->validateProvider($provider);

        return Socialite::driver($provider)->redirect();
    }

    private function validateProvider($provider)
    {
        if (!in_array($provider, ['facebook', 'google'])) {
            abort(404);
        }
    }

    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function loginSocialGoogle(): \Symfony\Component\HttpFoundation\RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    //callback
    public function getAuthenticatedLoginSocial(): \Illuminate\Http\RedirectResponse
    {
        try {

            $provider = 'google';

            $userService = new UserService();

            $user = $userService->findOrNewSocialUser($provider);

            Auth::login($user);

            if ($user->first_access) {
                return redirect()->to(route('home_panel'));
            }

            return redirect()->to(route('home_panel'));

        } catch (\Exception $e) {

            #dd('Opa',$e->getMessage(), $e->getTraceAsString());
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }
}
