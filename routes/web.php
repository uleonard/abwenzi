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
    'repayments' => 'RepaymentController',
    'commissions' => 'CommissionController'
]);

Route::resource('loans', 'LoanController')->except([
    'update', 'edit'
]);

Route::get('/loans/{id}/create', 'LoanController@create')->name('loans.create');
Route::post('/loans/search', 'LoanController@search')->name('loans.search');

/**
 * Clients  and Commissions Routes
 */
Route::post('/clients/search', 'ClientController@search')->name('clients.search');
Route::post('/commission/search', 'CommissionController@search')->name('commissions.search');
Route::get('/commission/{id}/pay', 'CommissionController@payCreate')->name('commissions.pay.create');
Route::post('/commission/pay', 'CommissionController@payStore')->name('commissions.pay.store');

//Route::get('/loans/types', 'LoanTypeController@index');
//Route::post('/loans/types', 'LoanTypeController@store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
