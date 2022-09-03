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
    
    //Registrar
    Route::post('new-enrollee', 'UserController@newEnrollee');
    Route::post('saveNew', 'UserController@saveNew');
    Route::post('editUser/{id}', 'UserController@editUser');
    Route::get('student/pagination','UserController@pagination');
    Route::post('searchStudent', 'UserController@search');
    Route::get('instructor/pagination','UserController@paginationInstructor');
    Route::post('searchInstructor', 'UserController@searchInstructor');
    Route::delete('deleteUser/{id}','UserController@deleteUser');
    Route::get('show/{id}','UserController@show');
    Route::post('edit-profile/{id}', 'UserController@editProfile');
    Route::post('edit-profile-nopic/{id}', 'UserController@editProfileNoPic');
    Route::get('index-program','ProgramController@indexPrograms');
    Route::get('add-program','ProgramController@ProgramsAdd');
    Route::get('update-program', 'ProgramController@ProgramsUpdate');
    Route::post('searchProgram','ProgramController@searchProgram');

    // subject 
    Route::get('index-subject','SubjectController@indexPrograms');
    Route::get('add-subject','SubjectController@subjectAdd');
    Route::get('update-subject', 'SubjectController@SubjectUpdate');
    Route::post('searchSubject','SubjectController@searchSubject');

    
    
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('new', 'UserController@new');

Route::get('approval-request/{id_number}', 'UserController@ApprovalRequest');
Route::get('number', 'UserController@number');