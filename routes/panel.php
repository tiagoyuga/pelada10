<?php

Route::namespace('Panel')
    #->middleware(['auth.panel', 'auth'])
    ->middleware([])
    ->prefix('panel')
    ->group(function ($panel) {

        #$panel->get('/', 'DashboardController@dashboard')->name("dashboard");
        $panel->get('/iframe', 'DashboardController@iframe')->name("iframe");

        #users
        $panel->resource('users', UserController::class);

        /* panel/profile */
        $panel->put('profile', 'AdministratorController@profileUpdate')->name('administrators.profileUpdate');
        $panel->get('profile', 'AdministratorController@profile')->name('administrators.profile');

        /* panel/users */
        $panel->get('users/find', 'AdministratorController@find')->name('users.find');

        $panel->put('administrators/image', 'AdministratorController@updateImageCrop')->name('administrators.updateImageCrop');
        $panel->get('administrators/crop/{id}', 'AdministratorController@imageCrop')->name('administrators.imageCrop');
        $panel->resource('administrators', AdministratorController::class);

        /* panel/clients */
        $panel->get('clients/find', 'ClientController@find')->name('clients.find');
        $panel->put('clients/image', 'ClientController@updateImageCrop')->name('clients.updateImageCrop');
        $panel->get('clients/crop/{id}', 'ClientController@imageCrop')->name('clients.imageCrop');
        $panel->resource('clients', ClientController::class);

        /* panel/categories */
        $panel->post('categories/find', 'CategoryController@find')->name('categories.find');
        $panel->resource('categories', CategoryController::class);
        $panel->get('categories-list', 'CategoryController@list')->name('categories.list');
        $panel->get('categories-find', 'CategoryController@find')->name('categories.find');
        $panel->get('categories-options', 'CategoryController@options');

        /* panel/products/images*/
        $panel->get('products/{product}/gallery/', 'ImageController@index')->name('products.gallery');
        $panel->get('gallery/crop/image/{id}', 'ImageController@imageCrop')->name('products.imageCrop');
        $panel->put('gallery/update-crop/image/{id}', 'ImageController@updateImageCrop')->name('products.updateImageCrop');
        $panel->delete('gallery/destroy/{image}', 'ImageController@destroy')->name('gallery.image.destroy');
        $panel->post('products/{product}/gallery/image/create', 'ImageController@store')->name('gallery.image.create');
        $panel->post('products/{product}/gallery/image/{image}/update', 'ImageController@update')->name('gallery.image.update');

        /* panel/products */
        $panel->get('products/find', 'ProductController@find')->name('products.find');

        $panel->get('products-images-list/{product}', 'ImageController@showImages')->name('products-images-list');
        $panel->delete('products-images-delete/{product}/{image}', 'ImageController@deleteImage')->name('products-images-delete');
        $panel->put('products-images-main/{product}/{image}', 'ImageController@productMainImage')->name('products-images-main');
        $panel->post('products-store-image/{product}', 'ImageController@storeImage')->name('products-store-image');

        $panel->resource('products', ProductController::class);
        $panel->get('products-list', 'ProductController@list')->name('products-list');
        $panel->get('products-group-list/{product}', 'ProductController@listGroup')->name('products-group-list');
        $panel->post('products-store', 'ProductController@store')->name('products-store');

        $panel->post('products-store-group/{product}', 'ProductController@storeGroup')->name('products-store-group');

        $panel->get('product-item/create', 'ProductController@createItem')->name('product-item.create');
        $panel->post('products-item-store', 'ProductController@storeItem')->name('products-item-store');
        $panel->get('products-item/{product}/edit', 'ProductController@editItem')->name('products-item.edit');

        $panel->get('products/change_type/{product}', 'ProductController@changeType')->name('products.change-type');

        /* panel/banner_types */
        $panel->resource('banner_types', BannerTypeController::class);

        /* panel/banners */
        $panel->resource('banners', BannerController::class);

        /* panel/payment_methods */
        $panel->resource('payment_methods', PaymentMethodController::class);

        /* panel/types */
        $panel->resource('types', TypeController::class);

        /* panel/coupons */
        $panel->resource('coupons', CouponController::class);

        /* panel/ratings */
        $panel->resource('ratings', RatingController::class)->only(['index']);

        /* panel/cities */
        $panel->get('cities/find', 'CityController@find')->name('cities.find');

        /* panel/addresses */
        $panel->resource('addresses', AddressController::class);

        /* panel/configurations */
        $panel->resource('configurations', ConfigurationController::class);

        /* panel/cashback_campaigns */
        $panel->resource('cashback_campaigns', CashbackCampaignController::class);

        /* panel/social_accounts */
        #$panel->resource('social_accounts', SocialAccountController::class);

        /* panel/push_notifications */
        $panel->resource('push_notifications', PushNotificationController::class)->only(['index', 'create', 'store']);

        /* panel/management_indications */
        $panel->resource('management_indications', ManagementIndicationsController::class)->only(['index']);

        /*panel/first_purchase*/
        $panel->get('first_purchase/index', 'FirstPurchaseController@index')
            ->name('first_purchase.index');

        $panel->post('first_purchase/update', 'FirstPurchaseController@update')
            ->name('first_purchase.update');

        $panel->post('products/find', 'ProductController@find')->name('products.find');

        /* panel/payment_options */
        $panel->resource('payment_options', PaymentOptionController::class);

        $panel->resource('sale_update', UpdateSaleController::class)->only(['index']);

    /* panel/pickup_addresses */
        $panel->resource('pickup_addresses', PickupAddressController::class);

        # rotas para panel

        /*
         * Rotas de crop de imagens
         * */
        $panel->get('banners/crop/{id}', 'BannerController@imageCrop')->name('banners.imageCrop');
        $panel->put('banners/update-crop/{id}', 'BannerController@updateImageCrop')->name('banners.updateImageCrop');

        $panel->get('products/crop/{id}', 'ProductController@imageCrop')->name('products.imageCrop');
        $panel->put('products/update-crop/{id}', 'ProductController@updateImageCrop')->name('products.updateImageCrop');

        /*images-crop*/
        $panel->get('images/crop/{id}', 'ImageController@imageCrop')->name('images.imageCrop');
        $panel->put('images/update-crop/{id}', 'ImageController@updateImageCrop')->name('images.updateImageCrop');
        //$panel->get('images/crop-diff-default-image/{id}/{attr_name}/{config_module}', 'ImagesController@imageCropOtherImageSameController')->name('images.imageCropOtherImageSameController');
    });
