<?php

use Illuminate\Support\Facades\Route;
use App\Models\Car;

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
    return view('welcome', ['cars'=>Car::orderByDesc('created_at')->where('visible',true)->where('popular',true)->get()]);
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resources([
    'basket' => 'BasketController',
    'cars' => 'CarsController',
    'admin' => 'AdminController',
]);

Route::put('/hide', 'CarsController@hide')->name('cars.hide');
Route::put('/popularize', 'CarsController@popularize')->name('cars.popularize');
Route::get('/search', 'CarsController@search')->name('search.index');
Route::delete('/delete', 'CarsController@destroy')->name('cars.destroy');
Route::delete('/bdelete', 'BasketController@destroy')->name('cars.destroy');
Route::get('/buy', 'BasketController@buy')->name('buy');

require __DIR__.'/auth.php';