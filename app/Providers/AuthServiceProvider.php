<?php

namespace App\Providers;

use App\Models\Configuration;
use App\Policies\ConfigurationPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
#use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\User' => 'App\Policies\UserPolicy',
        'App\Models\Event' => 'App\Policies\EventPolicy',
        'App\Models\Configuration' => 'App\Policies\ConfigurationPolicy',
        #Configuration::class => ConfigurationPolicy::class,
        //'App\Models\ManagementLink' => 'App\Policies\ManagementLinkPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        #Passport::routes();

        //Passport::cookie('aaaaaaaaaaaaa_token');

        /*Passport::tokensExpireIn(now()->addDays(15));

        Passport::refreshTokensExpireIn(now()->addDays(30));

        Passport::personalAccessTokensExpireIn(now()->addMonths(6));*/

        /*Passport::routes(function ($router) {
            $router->forAccessTokens();
            $router->forPersonalAccessTokens();
            $router->forTransientTokens();
        });*/

        #Passport::tokensExpireIn(now()->addMinutes(10));

        #Passport::refreshTokensExpireIn(now()->addDays(10));

    }
}
