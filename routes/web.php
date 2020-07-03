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




Route::resources([
    //'loans' => 'LoanController',
    'clients' => 'ClientController',
    'repayments' => 'RepaymentController'
]);

Route::resource('loans', 'LoanController')->except([
    'update', 'edit'
]);

Route::get('/loans/{id}/create', 'LoanController@create');

//Route::get('/loans/types', 'LoanTypeController@index');
//Route::post('/loans/types', 'LoanTypeController@store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
