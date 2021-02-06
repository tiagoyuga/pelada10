<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->to('/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('social-auth-google', 'Auth\LoginSocialController@loginSocialGoogle')->name('social-auth-google');
Route::get('social-auth-callback', 'Auth\LoginSocialController@getAuthenticatedLoginSocial')->name('social-auth-callback');

Route::match(['get', 'post'], '/loginManual', 'Auth\LoginController@login')->name('loginManual');
Route::match(['get', 'post'], '/logoutManual', 'Auth\LoginController@logout')->name('logoutManual');

#Route::get('/', "HomeController@index");

Route::namespace('Web')
    ->middleware(['auth.web', 'auth'])
    #->middleware('auth')
    ->prefix('web')
    ->group(function ($web) {

        $web->get('/home', 'DashboardController@index')->name('home');

        $web->get('/iframe', 'HomeController@iframe')->name("iframe");

        $web->get('/', 'DashboardController@dashboard')->name("dashboard");

        /* panel/profile */
        $web->put('profile', 'AdministratorController@profileUpdate')->name('administrators.profileUpdate');
        $web->get('profile', 'AdministratorController@profile')->name('administrators.profile');

        /* panel/users */
        $web->get('users/find', 'AdministratorController@find')->name('users.find');

        /* panel/clients */
        $web->get('clients/find', 'ClientController@find')->name('clients.find');
        $web->put('clients/image', 'ClientController@updateImageCrop')->name('clients.updateImageCrop');
        $web->get('clients/crop/{id}', 'ClientController@imageCrop')->name('clients.imageCrop');
        $web->resource('clients', ClientController::class);


        /* panel/push_notifications */
        #$web->resource('push_notifications', PushNotificationController::class)->only(['index', 'create', 'store']);

        /* panel/management_indications */
        #$web->resource('management_indications', ManagementIndicationsController::class)->only(['index']);

        /*panel/first_purchase*/

        # rotas para panel

        /*
         * Rotas de crop de imagens
         * */
        #$web->get('banners/crop/{id}', 'BannerController@imageCrop')->name('banners.imageCrop');
        #$web->put('banners/update-crop/{id}', 'BannerController@updateImageCrop')->name('banners.updateImageCrop');

        #$web->get('products/crop/{id}', 'ProductController@imageCrop')->name('products.imageCrop');
        #$web->put('products/update-crop/{id}', 'ProductController@updateImageCrop')->name('products.updateImageCrop');

        /*images-crop*/
        #$web->get('images/crop/{id}', 'ImageController@imageCrop')->name('images.imageCrop');
        #$web->put('images/update-crop/{id}', 'ImageController@updateImageCrop')->name('images.updateImageCrop');
        //$web->get('images/crop-diff-default-image/{id}/{attr_name}/{config_module}', 'ImagesController@imageCropOtherImageSameController')->name('images.imageCropOtherImageSameController');
    });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
