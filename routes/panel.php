<?php

Route::get('/', function () {
    return redirect()->to('/login');
});

Route::get('/home', 'HomeController@index');

Route::get('social-auth-google', 'Auth\LoginSocialController@loginSocialGoogle')->name('social-auth-google');
Route::get('social-auth-callback', 'Auth\LoginSocialController@getAuthenticatedLoginSocial')->name('social-auth-callback');

Route::match(['get', 'post'], '/loginManual', 'Auth\LoginController@login')->name('loginManual');
Route::match(['get', 'post'], '/logoutManual', 'Auth\LoginController@logout')->name('logoutManual');

Route::namespace('Panel')
    ->middleware(['auth'])
    ->prefix('panel')
    ->group(function ($panel) {

        #$panel->get('/', 'DashboardController@dashboard')->name("dashboard");
        #$panel->get('/iframe', 'DashboardController@iframe')->name("iframe");

        $panel->get('/', 'HomeController@index')->name('home_panel');
        $panel->get('/home', 'HomeController@index')->name('home_panel');
        $panel->get('/home', 'HomeController@index')->name('home');

        #$panel->get('/dashboard', 'DashboardController@dashboard')->name("dashboard");
        $panel->get('/dashboard', 'HomeController@dashboard')->name("dashboard");

        $panel->get('/iframe', 'HomeController@iframe')->name("iframe");

        /* panel/profile */
        $panel->get('profile', 'ProfileController@edit')->name('profile');
        $panel->put('profile', 'ProfileController@update')->name('profileUpdate');

        #users
        $panel->resource('users', UserController::class);
        #$panel->put('users', 'UserController@update')->name('products.updateImageCrop');

        /* panel/users */
        #$panel->get('users/find', 'AdministratorController@find')->name('users.find');

        #$panel->put('administrators/image', 'AdministratorController@updateImageCrop')->name('administrators.updateImageCrop');
        #$panel->get('administrators/crop/{id}', 'AdministratorController@imageCrop')->name('administrators.imageCrop');
        #$panel->resource('administrators', AdministratorController::class);

        /* panel/ratings */
        #$panel->resource('ratings', RatingController::class)->only(['index']);

        /* panel/cities */
        #$panel->get('cities/find', 'CityController@find')->name('cities.find');

        /* panel/addresses */
        #$panel->resource('addresses', AddressController::class);

        /* panel/configurations */
        #$panel->resource('configurations', ConfigurationController::class);

        /* panel/social_accounts */
        #$panel->resource('social_accounts', SocialAccountController::class);

        /* panel/push_notifications */
        #$panel->resource('push_notifications', PushNotificationController::class)->only(['index', 'create', 'store']);

        /* panel/management_indications */
        #$panel->resource('management_indications', ManagementIndicationsController::class)->only(['index']);

        # rotas para panel

        /*
         * Rotas de crop de imagens
         * */
        #$panel->get('banners/crop/{id}', 'BannerController@imageCrop')->name('banners.imageCrop');
        #$panel->put('banners/update-crop/{id}', 'BannerController@updateImageCrop')->name('banners.updateImageCrop');

        #$panel->get('products/crop/{id}', 'ProductController@imageCrop')->name('products.imageCrop');
        #$panel->put('products/update-crop/{id}', 'ProductController@updateImageCrop')->name('products.updateImageCrop');

        /*images-crop*/
        #$panel->get('images/crop/{id}', 'ImageController@imageCrop')->name('images.imageCrop');
        #$panel->put('images/update-crop/{id}', 'ImageController@updateImageCrop')->name('images.updateImageCrop');
        //$panel->get('images/crop-diff-default-image/{id}/{attr_name}/{config_module}', 'ImagesController@imageCropOtherImageSameController')->name('images.imageCropOtherImageSameController');
    });
