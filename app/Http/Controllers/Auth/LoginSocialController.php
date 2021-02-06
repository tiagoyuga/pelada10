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
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function callback($provider)
    {

        $this->validateProvider($provider);

        $userSocial = Socialite::driver($provider)->stateless()->user();

        $user = User::where(['email' => $userSocial->getEmail()])->first();

        if ($user) {
            Auth::login($user);
            return redirect('/');
        } else {
            $user = User::create([
                'name' => $userSocial->getName(),
                'email' => $userSocial->getEmail(),
                'image' => '',#$userSocial->getAvatar(),
                'provider_id' => $userSocial->getId(),
                'provider' => $provider,
            ]);
            return redirect()->route('home');
        }
    }*/

    public function loginSocialGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    //callback
    public function getAuthenticatedLoginSocial()
    {
        try {

            $provider = 'google';

            $userService = new UserService();

            $user = $userService->findOrNewSocialUser($provider);

            Auth::login($user);
dd('Deu certo');
            if ($user->first_access) {

                return redirect()->to(route('home'));
            }

            return redirect()->to('/home');

        } catch (\Exception $e) {

            #dd('Opa',$e->getMessage(), $e->getTraceAsString());
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }
}
