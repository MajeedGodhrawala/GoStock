<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\BrokerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

//Login-Registration-Logout
Route::get('login',[GuestController::class,'login'])->name('login');
Route::get('register',[GuestController::class,'register']);

Route::post('loginUser',[GuestController::class,'loginUser']);
Route::get('logout',[GuestController::class,'logout']);
Route::get('unauthenticatPage',[GuestController::class,'unauthenticatPage'])->name('unauthenticatPage');
Route::get('userData',[DashboardController::class,'userData']);
//

//App
Route::middleware('auth')->group(function() {
    Route::get('dashboard',[DashboardController::class,'dashboard']);
    Route::get('profile',[ProfileController::class,'profile'])->middleware('role_permission:view_profile');
    Route::get('broker',[BrokerController::class,'broker'])->middleware('role_permission:view_broker');
    Route::get('permission',[PermissionController::class,'permission']);
    Route::get('role',[RoleController::class,'role'])->middleware('role_permission:view_role');
});
// 

Route::post('addUser',[GuestController::class,'createUser']);
Route::post('editProfile',[ProfileController::class,'update']);

//Broker
// Route::post('brokerCreateOrUpdate/{broker?}',[BrokerController::class,'createOrUpdate']);
Route::post('brokerCreateOrUpdate/{broker?}',[BrokerController::class,'createOrUpdate'])->middleware('role_permission:edit_broker|add_broker');
Route::post('deleteBrokerData/{broker}',[BrokerController::class,'destroy'])->middleware('role_permission:delete_broker');
Route::post('getBrokerData',[BrokerController::class,'getAllBroker']);
Route::post('deleteBrokerRecords',[BrokerController::class,'deleteBrokerRecords'])->middleware('role_permission:delete_selected_broker');
Route::post('uploadCsvFile',[BrokerController::class,'import'])->middleware('role_permission:import_broker');
Route::get('exportFile',[BrokerController::class,'export'])->middleware('role_permission:export_broker');
// 

//Role
Route::post('roleCreateOrUpdate/{role?}',[RoleController::class,'createOrUpdate'])->middleware('role_permission:edit_role|add_role');
Route::post('delete/{role}',[RoleController::class,'destroy'])->middleware('role_permission:delete_role');
Route::post('get-role-data',[RoleController::class,'getAllRole']);

//

// Permission
Route::post('update-role_permission',[PermissionController::class,'updateRolePermission']);
