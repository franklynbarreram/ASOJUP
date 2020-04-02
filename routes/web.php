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
	Route::get('inscribedUsers/profile/{id}', ['as' => 'inscribed_users.edit', 'uses' => 'InscribedUsersController@edit_profile']);
	Route::put('inscribedUsers/profile', ['as' => 'inscribed_users.update', 'uses' => 'InscribedUsersController@update_profile']);
	Route::put('inscribedUsers/profile/password', ['as' => 'inscribed_users.password', 'uses' => 'InscribedUsersController@password_profile']);
	
	Route::resource('inscribedUsers', 'InscribedUsersController');



	//Medicines
	Route::resource('medicines', 'Medicines\MedicineController');
	Route::resource('forms', 'Medicines\MedicineFormController');
	Route::resource('units', 'Medicines\MedicineUnitController');

	Route::post('medicines/eliminar', 'Medicines\MedicineController@delete');
	Route::post('forms/eliminar', 'Medicines\MedicineFormController@delete');
	Route::post('units/eliminar', 'Medicines\MedicineUnitController@delete');
	Route::post('needs/eliminar', 'NeedController@delete');
	//Needs (diseases and specific benefits)
	Route::resource('needs', 'NeedController');
});

