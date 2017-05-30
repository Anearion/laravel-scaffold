<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use Illuminate\Http\Request;
use App\Models\Role;

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/', 'HomeController@index');


Route::group(['prefix' => 'admin', 'middleware'=>'auth'], function () {
  Route::get('/dashboard', 'HomeController@adminDashboard');


  Route::get('/users', 'AdminController@usersManagement');
  Route::post('/users', 'AdminController@saveUser');
  Route::put('/users', 'AdminController@editUser');
  Route::delete('/users', 'AdminController@deleteUser');




  Route::get('/roles', 'AdminController@rolesManagement');
  Route::post('/roles', 'AdminController@saveRole');
  Route::put('/roles', 'AdminController@editRole');
  Route::delete('/roles', 'AdminController@deleteRole');
});