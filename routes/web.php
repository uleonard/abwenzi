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
    return view('auth.login');
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
Route::post('/loans/defaulters', 'LoanController@defaulters')->name('loans.defaulters');

Route::post('/loans/attachments/store', 'LoanAttachmentController@store')->name('loans.attachments.store');

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


/**
 * Routes for Shareholders
 */

Route::get('/shareholders', 'ShareholderController@index')->name('shareholders.index');
Route::get('/shareholders/create', 'ShareholderController@create')->name('shareholders.create');
Route::post('/shareholders', 'ShareholderController@store')->name('shareholders.store');
Route::get('/shareholders/{id}', 'ShareholderController@show')->name('shareholders.show');
Route::get('/shareholders/edit', 'ShareholderController@edit')->name('shareholders.edit');
Route::post('/shareholders/search', 'ShareholderController@search')->name('shareholders.search');

/**
 * Routes for Beneficiaries
 */

Route::post('/beneficiaries', 'BeneficiaryController@store')->name('beneficiaries.store');

/**
 * Routes for Equities and Savings
 */

Route::get('/equities', 'EquityController@index')->name('equities.index');
Route::post('/equities', 'EquityController@store')->name('equities.store');
Route::post('/equities/search', 'EquityController@search')->name('equities.search');
Route::get('/equities/void', 'EquityController@destroy')->name('equities.destroy');
Route::post('/savings', 'SavingController@store')->name('savings.store');

//Route::get('/loans/types', 'LoanTypeController@index');
//Route::post('/loans/types', 'LoanTypeController@store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/agent', 'HomeController@agent')->name('home.agent');
