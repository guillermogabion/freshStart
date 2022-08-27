<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('loginTest','UserController@loginTrial');
Route::post('login','UserController@login');
Route::post('loginID','UserController@loginID');
Route::post('UserRegistration','UserController@saveNew');
Route::post('addMeal', 'MealController@addMeal');

Route::post('/logout', 'UserControler@logout')->middleware('auth:api');
Route::post('/logout2', 'UserControler@logout2')->middleware('auth:api');


Route::middleware('auth:api')->group(function () {
    Route::get('self', 'UserController@self');
    

    Route::get('user', 'UserController@index');
        // user
    Route::post('saveNew', 'UserController@saveNew');
    Route::post('editUser/{id}', 'UserController@editUser');
    Route::get('users/pagination','UserController@pagination');
    Route::delete('deleteUser/{id}','UserController@deleteUser');

    //Registrar
    Route::post('new-enrollee', 'UserController@newEnrollee');
   
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('getScheduledDish', 'ScheduledDishController@scheduledDish');


Route::get('getAllMeal', 'MealController@getAllMeal');