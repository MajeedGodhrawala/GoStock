<?php

use App\Http\Controllers\GuestController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\BrokerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::post('addUser',[GuestController::class,'createUser']);
// Route::post('editProfile',[ProfileController::class,'update']);

// //Broker
// Route::post('addBroker',[BrokerController::class,'create']);
// Route::post('editBroker',[BrokerController::class,'update']);
// Route::post('deleteBrokerData/{broker}',[BrokerController::class,'destroy']);
// Route::post('getBrokerData',[BrokerController::class,'getAllBroker']);

// //Role
// Route::post('createOrUpdate/{role?}',[RoleController::class,'createOrUpdate']);
// Route::post('delete/{role}',[RoleController::class,'destroy']);
// Route::post('get-role-data',[RoleController::class,'getAllRole']);


