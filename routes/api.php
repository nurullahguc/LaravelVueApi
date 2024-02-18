<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LoginController;

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

Route::post('login', [LoginController::class, 'login']);
Route::middleware('auth:sanctum')->get('login_control', [LoginController::class, 'login_control']);

Route::group(['prefix' => 'with_auth', 'middleware' => 'auth:sanctum'], function () {
    Route::get('contacts', [ContactController::class, 'contacts']);
    Route::post('save_contact', [ContactController::class, 'saveContact']);
    Route::post('delete_contact/{id}', [ContactController::class, 'deleteContact']);
    Route::get('get_contact/{id}', [ContactController::class, 'getContact']);
    Route::post('update_contact/{id}', [ContactController::class, 'updateContact']);
    Route::get('profile_info', [ContactController::class, 'profile_info']);

});


Route::get('contacts', [ContactController::class, 'contacts']);
Route::post('save_contact', [ContactController::class, 'saveContact']);
Route::post('delete_contact/{id}', [ContactController::class, 'deleteContact']);
Route::get('get_contact/{id}', [ContactController::class, 'getContact']);
Route::post('update_contact/{id}', [ContactController::class, 'updateContact']);
