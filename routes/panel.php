<?php

Route::namespace('Panel')
    ->middleware(['auth.panel', 'auth', 'checkFirstAccess', 'checkHasEventCreated'])
    ->prefix('panel')
    ->group(function ($panel) {

        $panel->get('/', 'HomeController@index')->name('home_panel');
        $panel->get('/home', 'HomeController@index')->name('home_panel');
        $panel->get('/home', 'HomeController@index')->name('home');

        $panel->get('/dashboard', 'HomeController@dashboard')->name("dashboard");

        /* panel/profile */
        $panel->get('profile', 'ProfileController@edit')->name('profile');
        $panel->put('profile/{user}', 'ProfileController@update')->name('profileUpdate');

        /*panel/users*/
        Route::group(['prefix' => '/', 'middleware' => [/*'checkHasEventCreated'*/]], function ($panel) {
            #users
            $panel->put('administrators/image', 'UserController@updateImageCrop')->name('administrators.updateImageCrop');
            $panel->get('administrators/crop/{id}', 'UserController@imageCrop')->name('users.imageCrop');
            $panel->resource('users', UserController::class);

            /* panel/events */
            $panel->resource('events', EventController::class);

            /* panel/configuration */
            $panel->resource('configuration', ConfigurationController::class);#->only(['edit', 'update']);

            /* panel/events_user */
            $panel->resource('events_user', EventsUserController::class);

            # rotas para panel

        });


        #LIXO
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
