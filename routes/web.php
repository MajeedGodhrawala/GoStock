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

//

//App
Route::middleware('auth')->group(function() {
    Route::get('dashboard',[DashboardController::class,'dashboard']);
    Route::get('profile',[ProfileController::class,'profile']);
    Route::get('broker',[BrokerController::class,'broker']);
    Route::get('permission',[PermissionController::class,'permission']);
    Route::get('role',[RoleController::class,'role']);
});
// 

Route::post('addUser',[GuestController::class,'createUser']);
Route::post('editProfile',[ProfileController::class,'update']);

//Broker
// Route::post('brokerCreateOrUpdate/{broker?}',[BrokerController::class,'createOrUpdate']);
Route::post('deleteBrokerData/{broker}',[BrokerController::class,'destroy']);
Route::post('getBrokerData',[BrokerController::class,'getAllBroker']);
// 

//Role
Route::post('roleCreateOrUpdate/{role?}',[RoleController::class,'createOrUpdate']);
Route::post('delete/{role}',[RoleController::class,'destroy']);
Route::post('get-role-data',[RoleController::class,'getAllRole']);
Route::post('update-role_permission',[PermissionController::class,'updateRolePermission']);
//
Route::post('brokerCreateOrUpdate/{broker?}',[BrokerController::class,'createOrUpdate'])->middleware('role_permission:edit_broker|add_broker');