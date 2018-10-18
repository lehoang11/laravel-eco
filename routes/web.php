<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|---------------------------------------------------------------------
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
*/
#++++++++++++++++++++++++Free Route++++++++++++++++++++++++++++++
Route::get('/product/search', 'ProductController@search');

Route::group(['middleware' => 'backend.base'], function () {
 # Auth Route
    Auth::routes();


Route::get('/', 'WelcomeController@index')->name('home');

#products cate
Route::get('/cates/{id}/{alias}', 'ProductController@cates')->name('product_cates');
Route::get('/subcates/{id}/{alias}', 'ProductController@subcates')->name('product_subcates');

Route::get('/details/{id}/{alias}', 'ProductController@details')->name('product_details');

Route::get('/blog', 'WelcomeController@blog')->name('blog');

 #cart
Route::get('/addcart/{id}/{alias}', 'WelcomeController@addcart')->name('addcart');
Route::get('/shopcart', 'WelcomeController@shopcart')->name('shopcart');

Route::get('/deletecart/{id}', 'WelcomeController@deletecart')->name('deletecart');

Route::get('/updatecart/{id}/{qty}', 'AjaxController@updatecart')->name('updatecart');

Route::get('/checkaddress', 'WelcomeController@CheckAddress')->name('checkaddress');
Route::post('/checkaddress', 'WelcomeController@storeCheckAddress');

Route::get('/order', 'WelcomeController@order')->name('order');

#Paypal
Route::get('/checkout', 'PaypalController@Checkout')->name('checkout');
Route::get('/done', 'PaypalController@Done')->name('done');
Route::get('/cancel', 'PaypalController@Cancel')->name('cancel');
Route::get('/alltrans', 'PaypalController@Alltrans')->name('alltrans');

 });
Route::group(['middleware' => ['auth', 'backend.base']], function () {

	/*
|-------------------------------------------------
	 Add your website routes here (users are forced to login to access those)
|-------------------------------------------------
*/
	# Default home route
//Route::get('/home', 'HomeController@index');
});


#+++++++++++++++++++++Ecommerce Route++++++++++++++++++++++
Route::group(['middleware' => ['backend.base'], 'namespace' => 
	'Ecommerce', 'as' => 'site::'], function () {
});

Route::group(['middleware' => ['auth', 'backend.base'],'namespace' => 'Ecommerce', 'as' => 'site::'], function () {
});



/*
+---------------------------------------------------------------------
| backend Routes													
+---------------------------------------------------------------------
|                      									 Administration Panel		

+---------------------------------------------------------------------
| This route group applies the "web" middleware group to every route		|
| it contains. The "web" middleware group is defined in your HTTP			|
| kernel and includes session state, CSRF protection, and more.				|
| This routes are made to manage backend administration panel, please		|
| don't change anything unless you know what you're doing.																
+---------------------------------------------------------------------
*/

Route::group(['middleware' => ['auth', 'backend.base'], 'as' => 'backend::'], function () {

	Route::get('activate/{token?}', 'Auth\ActivationController@activate')->name('activate_account');
    Route::post('activate', 'Auth\ActivationController@activateWithForm')->name('activate_form');
    Route::get('/banned', function() {
        return view('auth/banned');
    })->name('banned');

});

Route::group(['middleware' => ['backend.base'], 'namespace' => 'Backend', 'as' => 'backend::'], function () {

	# Public document downloads
	Route::get('/document/{slug}', 'DownloadsController@downloader')->name('document_downloader');
	Route::post('/document/{slug}', 'DownloadsController@download');

	# Social auth
	Route::get('/social/{provider}', 'SocialController@redirectToProvider')->name('social');
	Route::get('/social/{provider}/callback', 'SocialController@handleProviderCallback')->name('social_callback');

	# Public language changer
	Route::get('/locale/{locale}', 'LocaleController@set')->name('locale');

});

Route::group(['middleware' => ['backend.base'], 'prefix' => 'admin', 'namespace' => 'Backend', 'as' => 'backend::'], function () {

	# Public document downloads
	Route::get('/install', 'InstallerController@locale')->name('install_locale');
	Route::get('/install/{locale}', 'InstallerController@show')->name('install');
	Route::post('/install/{locale}', 'InstallerController@installConfig');
	Route::get('/install/{locale}/confirm', 'InstallerController@install')->name('install_confirm');

});

Route::group(['middleware' => ['backend.base'], 'prefix' => 'admin', 'namespace' => 'Backend', 'as' => 'backend::'], function () {

	# Public document downloads
	Route::get('/install', 'InstallerController@locale')->name('install_locale');
	Route::get('/install/{locale}', 'InstallerController@show')->name('install');
	Route::post('/install/{locale}', 'InstallerController@installConfig');
	Route::get('/install/{locale}/confirm', 'InstallerController@install')->name('install_confirm');

});

Route::group(['middleware' => ['auth', 'backend.base', 'backend.auth'], 'prefix' => 'admin123s5', 'namespace' => 'Backend', 'as' => 'backend::'], function () {

	# Home Controller
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::get('/setting', 'DashboardController@setting')->name('setting');
    Route::get('/media', 'DashboardController@media')->name('media');
    Route::get('/ecommerce', 'DashboardController@ecommerce')->name('ecommerce');


    # Users Routes
    Route::get('/users', 'UsersController@index')->name('users');

    Route::get('/users/create', 'UsersController@create')->name('users_create');
    Route::post('/users/create', 'UsersController@store')->name('userstore');

    Route::get('/users/settings', 'UsersController@editSettings')->name('users_settings');
    Route::post('/users/settings', 'UsersController@updateSettings');

    Route::get('/users/{id}', 'UsersController@show')->name('users_profile');

	Route::get('/users/{id}/edit', 'UsersController@edit')->name('users_edit');
    Route::post('/users/{id}/edit', 'UsersController@update');

    Route::get('/users/{id}/roles', 'UsersController@editRoles')->name('users_roles');
    Route::post('/users/{id}/roles', 'UsersController@setRoles');

    Route::get('/users/{id}/delete', 'SecurityController@confirm')->name('users_delete');
    Route::post('/users/{id}/delete', 'UsersController@destroy');


    # Roles Routes
    Route::get('/roles', 'RolesController@index')->name('roles');

    Route::get('/roles/create', 'RolesController@create')->name('roles_create');
    Route::post('/roles/create', 'RolesController@store');

    Route::get('/roles/{id}', 'RolesController@show')->name('roles_show');

    Route::get('/roles/{id}/edit', 'RolesController@edit')->name('roles_edit');
    Route::post('/roles/{id}/edit', 'RolesController@update');

    Route::get('/roles/{id}/permissions', 'RolesController@editPermissions')->name('roles_permissions');
    Route::post('/roles/{id}/permissions', 'RolesController@setPermissions');

    Route::get('/roles/{id}/delete', 'SecurityController@confirm')->name('roles_delete');
    Route::post('/roles/{id}/delete', 'RolesController@destroy');


    # Permissions Routes
    Route::get('/permissions', 'PermissionsController@index')->name('permissions');

    Route::get('/permissions/create', 'PermissionsController@create')->name('permissions_create');
    Route::post('/permissions/create', 'PermissionsController@store');

    Route::get('/permissions/{id}/edit', 'PermissionsController@edit')->name('permissions_edit');
    Route::post('/permissions/{id}/edit', 'PermissionsController@update');

    Route::get('/permissions/{id}/delete', 'SecurityController@confirm')->name('permissions_delete');
    Route::post('/permissions/{id}/delete', 'PermissionsController@destroy');

	
	# Database CRUD
	Route::get('/CRUD', 'CRUDController@index')->name('CRUD');

	Route::get('/CRUD/{table}', 'CRUDController@table')->name('CRUD_table');

	Route::get('/CRUD/{table}/create', 'CRUDController@create')->name('CRUD_create');
	Route::post('/CRUD/{table}/create', 'CRUDController@createRow');

	Route::get('/CRUD/{table}/{id}', 'CRUDController@row')->name('CRUD_edit');
	Route::post('/CRUD/{table}/{id}', 'CRUDController@saveRow');

	Route::get('/CRUD/{table}/{id}/delete', 'SecurityController@confirm')->name('CRUD_delete');
	Route::post('/CRUD/{table}/{id}/delete', 'CRUDController@deleteRow');

	# API
	Route::get('/API', 'APIController@index')->name('API');

	# File Manager
	Route::get('/files', 'FilesController@files')->name('files');

	Route::get('/files/upload', 'FilesController@showUpload')->name('files_upload');
	Route::post('/files/upload', 'FilesController@upload');

	Route::get('/documents/{file}/create', 'DocumentsController@showCreate')->name('documents_create');
	Route::post('/documents/{file}/create', 'DocumentsController@createDocument');

	Route::get('/documents/{slug}/edit', 'DocumentsController@edit')->name('documents_edit');
	Route::post('/documents/{slug}/edit', 'DocumentsController@update');

	Route::get('/documents/{slug}/delete', 'SecurityController@confirm')->name('documents_delete');
	Route::post('/documents/{slug}/delete', 'DocumentsController@delete');

	Route::get('/files/{file}/delete', 'SecurityController@confirm')->name('files_delete');
	Route::post('/files/{file}/delete', 'FilesController@delete');

	Route::get('/files/{file}/download', 'FilesController@fileDownload')->name('files_download');

	# Profile
    Route::get('/profile', 'ProfileController@edit')->name('profile');
	Route::post('/profile', 'ProfileController@update');

	

 # Cates Routes
    Route::get('/cates', 'CateController@index')->name('cates');

    Route::get('/cates/create', 'CateController@create')->name('cates_create');
    Route::post('/cates/create', 'CateController@store');

    Route::get('/cates/{id}/edit', 'CateController@edit')->name('cates_edit');
    Route::post('/cates/{id}/edit', 'CateController@update');

    Route::get('/cates/{id}/delete', 'SecurityController@confirm')->name('cates_delete');
    Route::post('/cates/{id}/delete', 'CateController@destroy');


 # Products Routes
    Route::get('/products', 'ProductController@index')->name('products');

    Route::get('/products/create', 'ProductController@create')->name('products_create');
    Route::post('/products/create', 'ProductController@store');

    Route::get('/products/{id}/edit', 'ProductController@edit')->name('products_edit');
    Route::post('/products/{id}/edit', 'ProductController@update');

    Route::get('/products/{id}/delete', 'SecurityController@confirm')->name('products_delete');
    Route::post('/products/{id}/delete', 'ProductController@destroy');
    
    Route::get('/products/detail/{id}','ProductController@imgdetail');
    #Order
    Route::get('/order', 'OrderController@index')->name('order');
    Route::get('/order/details/{id}', 'OrderController@details')->name('order_details');
    Route::post('/order/{id}/delete', 'OrderController@destroy');

    Route::get('/order/{id}/delete', 'SecurityController@confirm')->name('order_delete');
    

});
