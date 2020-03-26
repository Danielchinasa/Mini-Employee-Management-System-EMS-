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

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('companies', 'CompanyController');
Route::Post('companies/{company_id}', 'CompanyController@update')->name('company.update');
Route::Post('companies/destroy/{company_id}', 'CompanyController@destroy')->name('company.destroy');

Route::resource('employees', 'EmployeeController');
Route::Post('employees/{employee_id}', 'EmployeeController@update')->name('employee.update');
Route::Post('employee/destroy/{employee_id}', 'EmployeeController@destroy')->name('employee.destroy');
