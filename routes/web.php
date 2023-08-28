<?php

use App\Http\Controllers\UserController;
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

// User Controller
    Route::get("/", [UserController::class, "index"]);
    Route::get("/update/{id}", [UserController::class, "UpdateUserPage"]);
    Route::post("/update_data/{id}", [UserController::class, "UpdateUser"]);
    Route::post("/add_user", [ UserController::class, "createUser" ]);
    Route::post("/delete_data/{id}", [ UserController::class, "DeleteUser" ]);
