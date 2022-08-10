<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Users;
use App\Http\Controllers\VehiclesController;
use App\Models\Role;

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


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    // return $request->user();
});
############################ Auth Apis ########################
Route::get('/addRole', [Role::class, 'add']);
Route::get('/omran', [AuthController::class, 'omran'])->name('omran');
Route::get('/register', [AuthController::class, 'register']);
Route::get('/index', [AuthController::class, 'index'])->name('index');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/get_all_data', [VehiclesController::class, 'getAllData']);
Route::get('/get_mapbox_Token', [AuthController::class, 'getMapBoxToken']);
Route::middleware('auth:sanctum')->group(function () {
Route::post('/me', [AuthController::class, 'me']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/edit_user_info', [Users::class, 'editUserInfo']);

########################### Vehicle Apis #########################
Route::post('/add_vehicle', [VehiclesController::class, 'addVehicle']);
Route::post('/edit_vehicle/{vehicleId}', [VehiclesController::class, 'editVehicle']);
Route::post('/delete_vehicle/{vehicleId}', [VehiclesController::class, 'deleteVehicle']);
Route::get('/view_all_vehicles', [VehiclesController::class, 'index']);
});
Route::post('/getVehicle', [VehiclesController::class, 'getVehicle']);
Route::get('/get_script', [VehiclesController::class, 'getScript']);
