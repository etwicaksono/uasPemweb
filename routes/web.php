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

// membuat fungsi redirect agar ketika diakses root langsung diarahkan ke dashboard
Route::get('/', function () {
    return redirect('/dashboard');
});

// route untuk menangani ketika belum ada data yang diinputkan
Route::get('/dashboard', 'HomeController@index');
Route::get('/pemasukan', 'IncomesController@index');
Route::get('/pemasukan/json', 'IncomesController@dt_json');

// route untuk menangani ketika sudah ada data yang diinputkan
Route::get('/insert_pemasukan', 'IncomesController@store');
Route::post('/income/delete/{id}', 'IncomesController@destroy');
Route::post('/pemasukan/{id}', 'IncomesController@show');
// Route::post('/pemasukan/edit/{id}', 'IncomesController@edit');
// Route::post('/dashboard', 'HomeController@postDashboard');