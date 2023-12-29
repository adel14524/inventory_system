<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

Route::controller(PermissionController::class)->group(function () {
    Route::get('/permission/all', 'index')->name('permission.all');
    Route::get('/permission/ajax', 'show')->name('permission.ajax');
    Route::get('/permission/add', 'create')->name('permission.add');
    Route::post('/permission/store', 'store')->name('permission.store');
    Route::get('/permission/edit/{id}', 'edit')->name('permission.edit');
    Route::post('/permission/update', 'update')->name('permission.update');
    Route::get('/permission/delete/{id}', 'destroy')->name('permission.delete');
});

Route::controller(RoleController::class)->group(function () {
    Route::get('/role/all', 'index')->name('role.all');
    Route::get('/role/ajax', 'show')->name('role.ajax');
    Route::get('/role/add', 'create')->name('role.add');
    Route::post('/role/store', 'store')->name('role.store');
    Route::get('/role/edit/{id}', 'edit')->name('role.edit');
    Route::post('/role/update', 'update')->name('role.update');
    Route::get('/role/delete/{id}', 'destroy')->name('role.delete');
});

Route::controller(UserController::class)->group(function () {
    Route::get('/user/all', 'index')->name('user.all');
    Route::get('/user/ajax', 'show')->name('user.ajax');
    Route::get('/user/add', 'create')->name('user.add');
    Route::post('/user/store', 'store')->name('user.store');
    Route::get('/user/edit/{id}', 'edit')->name('user.edit');
    Route::post('/user/update', 'update')->name('user.update');
    Route::get('/user/delete/{id}', 'destroy')->name('user.delete');
});

Route::controller(CategoryController::class)->group(function () {
    Route::get('/product/category/all', 'index')->name('category.all');
    Route::get('/product/category/ajax', 'show')->name('category.ajax');
    Route::get('/product/category/add', 'create')->name('category.add');
    Route::post('/product/category/store', 'store')->name('category.store');
    Route::get('/product/category/edit/{id}', 'edit')->name('category.edit');
    Route::post('/product/category/update', 'update')->name('category.update');
    Route::get('/product/category/delete/{id}', 'destroy')->name('category.delete');
});

Route::controller(TagController::class)->group(function () {
    Route::get('/product/tag/all', 'index')->name('tag.all');
    Route::get('/product/tag/ajax', 'show')->name('tag.ajax');
    Route::get('/product/tag/add', 'create')->name('tag.add');
    Route::post('/product/tag/store', 'store')->name('tag.store');
    Route::get('/product/tag/edit/{id}', 'edit')->name('tag.edit');
    Route::post('/product/tag/update', 'update')->name('tag.update');
    Route::get('/product/tag/delete/{id}', 'destroy')->name('tag.delete');
});
