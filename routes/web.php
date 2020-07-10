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
    'commissions' => 'CommissionController',
    'cash' => 'CashController',
    'expenses' => 'ExpensesController',
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

/**Other routes */

Route::post('/cash/search', 'CashController@search')->name('cash.search');
Route::post('/expenses/search', 'ExpensesController@search')->name('expenses.search');

/**
 * Routes for Expense Categories
 */

Route::get('/exp/categories', 'ExpenseCategoryController@index')->name('expenses.categories.index');
Route::get('/exp/categories/create', 'ExpenseCategoryController@create')->name('expenses.categories.create');
Route::post('/exp/categories/store', 'ExpenseCategoryController@store')->name('expenses.categories.store');
Route::post('/exp/categories/{id}/update', 'ExpenseCategoryController@update')->name('expenses.categories.update');


//Route::get('/loans/types', 'LoanTypeController@index');
//Route::post('/loans/types', 'LoanTypeController@store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
