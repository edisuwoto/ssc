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

Route::prefix('parentregistration')->group(function () {
    Route::get('/', 'ParentRegistrationController@index');
    Route::get('/about', 'ParentRegistrationController@about');
    Route::get('/registration', 'ParentRegistrationController@registration')->name('parentregistration/registration');

    Route::get('/get-class-academicyear', 'ParentRegistrationController@getClasAcademicyear');
    Route::get('/get-section', 'ParentRegistrationController@getSection');

    Route::get('/get-classes', 'ParentRegistrationController@getClasses');

    Route::post('/student-store', 'ParentRegistrationController@studentStore')->name('parentregistration-student-store');

    Route::get('/saas-student-list', 'ParentRegistrationController@saasStudentList')->name('parentregistration/saas-student-list');
    Route::post('/saas-student-list', 'ParentRegistrationController@saasStudentListsearch')->name('parentregistration/saas-student-list');

    Route::get('assign-section/{id}', 'ParentRegistrationController@assignSection');
    Route::post('assign-section-store', 'ParentRegistrationController@assignSectionStore')->name('parentregistration/assign-section-store');


    Route::get('/student-list', 'ParentRegistrationController@studentList')->name('parentregistration.student-list')->middleware('userRolePermission:543');
    Route::post('/student-list', 'ParentRegistrationController@studentListSearch');

    Route::post('student-approve', 'ParentRegistrationController@studentApprove')->name('parentregistration/student-approve')->middleware('userRolePermission:545');
    Route::get('student-view/{id}', 'ParentRegistrationController@studentView')->name('parentregistration/student-view')->middleware('userRolePermission:544');

    Route::post('student-delete', 'ParentRegistrationController@studentDelete')->name('parentregistration/student-delete')->middleware('userRolePermission:546');


    Route::get('check-student-email', 'ParentRegistrationController@checkStudentEmail');

    Route::get('check-student-mobile', 'ParentRegistrationController@checkStudentMobile');

    Route::get('check-guardian-email', 'ParentRegistrationController@checkGuardianEmail');

    Route::get('check-guardian-mobile', 'ParentRegistrationController@checkGuardianMobile');

    // setting route
    Route::get('settings', 'ParentRegistrationController@settings')->name('parentregistration/settings')->middleware('userRolePermission:547');
    Route::post('settings', 'ParentRegistrationController@Updatesettings')->name('parentregistration/settings');
});