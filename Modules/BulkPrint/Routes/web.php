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

Route::prefix('bulkprint')->group(function() {
//fees bulk print 

Route::get('student-id-card-bulk-print', ['as' => 'student-id-card-bulk-print', 'uses' => 'BulkPrintController@studentidBulkPrint'])->middleware('userRolePermission:921');
Route::post('student-id-card-bulk-print', ['as' => 'student-id-card-bulk-print-search', 'uses' => 'BulkPrintController@studentidBulkPrintSearch'])->middleware('userRolePermission:921');
Route::get('staff-id-card-bulk-print', ['as' => 'staff-id-card-bulk-print', 'uses' => 'BulkPrintController@staffidBulkPrint'])->middleware('userRolePermission:923');
Route::post('staff-id-card-bulk-print', ['as' => 'staff-id-card-bulk-print-search', 'uses' => 'BulkPrintController@staffidBulkPrintSearch'])->middleware('userRolePermission:923');
Route::get('fees-invoice-bulk-print', ['as' => 'fees-bulk-print', 'uses' => 'BulkPrintController@feeVoucherPrint'])->middleware('userRolePermission:926');
Route::post('fees-invoice-bulk-print', ['as' => 'fees-bulk-print-search', 'uses' => 'BulkPrintController@feeVoucherPrintSearch'])->middleware('userRolePermission:926');
Route::get('invoice-settings',['as' =>'invoice-settings','uses'=>'BulkPrintController@settings'])->middleware('userRolePermission:925');
Route::post('invoice-settings-update',['as' =>'invoice-settings-update','uses'=>'BulkPrintController@settingsUpdate'])->middleware('userRolePermission:925');
Route::get('payroll-bulk-print', ['as' => 'payroll-bulk-print', 'uses' => 'BulkPrintController@payrollBulkPrint'])->middleware('userRolePermission:924');
Route::post('payroll-bulk-print', ['as' => 'payroll-bulk-print-seacrh', 'uses' => 'BulkPrintController@payrollBulkPrintSearch'])->middleware('userRolePermission:924');
Route::get('certificate-bulk-print', ['as' => 'certificate-bulk-print', 'uses' => 'BulkPrintController@certificateBulkPrint'])->middleware('userRolePermission:922');
Route::post('certificate-bulk-print', ['as' => 'certificate-bulk-print-seacrh', 'uses' => 'BulkPrintController@certificateBulkPrintSearch'])->middleware('userRolePermission:922');
Route::get('ajaxIdCard', ['as' => 'ajaxIdCard', 'uses' => 'BulkPrintController@ajaxIdCard']);
Route::get('ajaxRoleIdCard', ['as' => 'ajaxRoleIdCard', 'uses' => 'BulkPrintController@ajaxRoleIdCard']);
});