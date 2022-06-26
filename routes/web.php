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
	return redirect()->route('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('inscribedUsers/profile/{id}', ['as' => 'inscribed_users.edit', 'uses' => 'InscribedUsersController@edit_profile']);
Route::put('inscribedUsers/profile', ['as' => 'inscribed_users.update', 'uses' => 'InscribedUsersController@update_profile']);
Route::put('inscribedUsers/profile/password', ['as' => 'inscribed_users.password', 'uses' => 'InscribedUsersController@password_profile']);


Route::group(['middleware' => 'auth'], function () {

	//Custom logout
	Route::get('admin/logout', function () {
		Auth::logout();
		
		return redirect()->route('login');
	})->name('admin.logout');

	Route::resource('user', 'UserController', ['except' => ['show']]);
	
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

	//Edit inscribedUsers
	Route::put('inscribedUsers/inhabilitate/{id}', 'InscribedUsersController@ajaxInhabilitate');
	Route::resource('inscribedUsers', 'InscribedUsersController');

	//Survivors
	Route::group(['prefix' => 'survivors', 'as' => 'survivors.'], function () {
		Route::get('', 'SurvivorController@index')->name('index');
		Route::get('create', 'SurvivorController@create')->name('create');
		Route::post('', 'SurvivorController@store')->name('store');
		Route::get('{id}/edit', 'SurvivorController@edit')->name('edit');
		Route::put('{id}', 'SurvivorController@update')->name('update');
	});

	//Medicines
	Route::post('medicines/ajax/store', 'Medicines\MedicineController@ajaxStore')->name('medicines.ajax.store');
	Route::resource('medicines', 'Medicines\MedicineController');
	Route::resource('forms', 'Medicines\MedicineFormController');
	Route::resource('units', 'Medicines\MedicineUnitController');

	Route::post('medicines/eliminar', 'Medicines\MedicineController@delete');
	Route::post('forms/eliminar', 'Medicines\MedicineFormController@delete');
	Route::post('units/eliminar', 'Medicines\MedicineUnitController@delete');
	Route::post('needs/eliminar', 'NeedController@delete');

	//Needs (diseases and specific benefits)
	Route::post('needs/ajax/store', 'NeedController@ajaxStore');
	Route::resource('needs', 'NeedController');

	//Listing
	Route::get('listings/history/{id}', 'ListingController@history')->name('listings.history');
	Route::get('listings/search', 'ListingController@search')->name('listings.search');
	Route::get('listings/current/{id}', 'ListingController@currentItems')->name('listings.current');
	Route::post('listings/pickItem', 'ListingController@pickItem')->name('listings.pick');
	Route::put('listings/updateAmount', 'ListingController@updateAmount')->name('listings.updateAmount');
	Route::delete('listings/deleteItem', 'ListingController@deleteItem')->name('listings.deleteItem');
	Route::get('listings/users/table', 'ListingController@getInscribedTable')->name('listings.test');
	Route::resource('listings', 'ListingController');

	Route::resource('delegates', 'DelegateController');
	Route::post('delegates/eliminar', 'DelegateController@eliminar');
	Route::resource('permissions', 'PermissionController');
});

