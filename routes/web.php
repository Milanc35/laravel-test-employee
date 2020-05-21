<?php

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

Auth::routes(['register' => false]);
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('locale/{locale?}', ['as'=>'set-locale', 'uses'=>'HomeController@setLocale']);

// Route::get('/home', 'HomeController@index')->name('home');
Route::prefix('admin')->middleware(['auth', 'locale'])->name('admin.')->group(function () {
    Route::get('', 'HomeController@dashboard');
    Route::resources([
        'companies' => 'CompanyController',
        'employees' => 'EmployeeController',
    ]);
});
