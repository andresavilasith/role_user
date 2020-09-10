<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/user','Backend\Role_User\UserController')->names('user');

Route::resource('/role','Backend\Role_User\RoleController')->names('role');

Route::resource('/category','Backend\Role_User\CategoryController')->names('category');

Route::resource('/permission','Backend\Role_User\PermissionController')->names('permission');