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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');





// Product Route Start 

Route::group(['prefix'=>'category', 'as'=>'category.', 'middleware'=>['auth'] ],function(){
    Route::get('/list', [
        'uses'  =>'CategoryController@index',
        'as'    =>'list'
    ]);
    Route::POST('/store',[
        'uses'  => 'CategoryController@store',
        'as'    => 'store'
    ]);
    Route::GET('/destroy',[
        'uses'  => 'CategoryController@destroy',
        'as'    => 'destroy'
    ]);
});




















