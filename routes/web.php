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
Route::group(['namespace' => 'App\Http\Controllers\Admin', 'prefix' => 'admin'], function() {
    Route::get('/', 'IndexController')->name('admin.index');
    Route::get('/users', 'UserController@index')->name('admin.user.index');

    Route::get('/roles', 'RoleController@index')->name('admin.role.index');
    Route::patch('/roles/{role}', 'RoleController@update')->name('admin.role.update');

    Route::get('/gallery', 'GalleryController@index')->name('admin.gallery.index');
    Route::post('/gallery', 'GalleryController@store')->name('admin.gallery.store');
    Route::patch('/gallery/{image}', 'GalleryController@update')->name('admin.gallery.update');
    Route::delete('/gallery/{image}', 'GalleryController@destroy')->name('admin.gallery.destroy');
    Route::delete('/gallery', 'GalleryController@destroy_selected')->name('admin.gallery.destroy.selected');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
