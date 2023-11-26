<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\middleware\CheckRole;

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

Route::middleware(['auth:sanctum', 'checkRole:doctor,administrator,manager'])->group(function() {
    Route::get("/clients", "App\Http\Controllers\ClientController@getAllClients");
    Route::get("/softdeletedclients", "App\Http\Controllers\ClientController@getSoftDeletedClients");
    Route::post("/clients", "App\Http\Controllers\ClientController@createClient");
    Route::delete("/clients/{id}", "App\Http\Controllers\ClientController@deleteClient");
    Route::delete("/clients/{id}/force", "App\Http\Controllers\ClientController@forceDeleteClient");
    Route::post("/clients/{id}/restore", "App\Http\Controllers\ClientController@restoreClient");
    Route::put("/clients/{id}", "App\Http\Controllers\ClientController@updateClient");
    Route::get("/administrators", "App\Http\Controllers\UserController@getAdministrators");
    Route::get("/doctors", "App\Http\Controllers\UserController@getDoctors");
    Route::get("/managers", "App\Http\Controllers\UserController@getManagers");
});

Route::middleware('auth:sanctum')->get("/clients/{id}", "App\Http\Controllers\ClientController@getClientById");
Route::middleware('auth:sanctum')->post("/clients/{id}/image", "App\Http\Controllers\ClientController@uploadImage");
Route::get("/clients/{id}/image", "App\Http\Controllers\ClientController@serveImage");


//auth routes
Route::post("/login", "App\Http\Controllers\UserController@login");
Route::post("/forgot-password", "App\Http\Controllers\UserController@forgotPassword");
Route::middleware('auth:sanctum')->post("/register", "App\Http\Controllers\UserController@register");
Route::middleware('auth:sanctum')->post("/logout", "App\Http\Controllers\UserController@logout");
Route::middleware('auth:sanctum')->post("/change-password", "App\Http\Controllers\UserController@changePassword");
Route::middleware('auth:sanctum')->post("/change-email", "App\Http\Controllers\UserController@changeEmail");
// Route to handle notes for a specific client
Route::middleware(['auth:sanctum', 'checkRole:doctor,administrator'])->group(function() {
    Route::prefix('/clients/{client_id}')->group(function () {
        Route::post('/notes', 'App\Http\Controllers\NoteController@store');
        Route::put('/notes/{note}', 'App\Http\Controllers\NoteController@update');
        Route::delete('/notes/{note}', 'App\Http\Controllers\NoteController@destroy');
    });
});
Route::middleware('auth:sanctum')->get('/clients/{client_id}/notes', 'App\Http\Controllers\NoteController@index');


Route::middleware(['auth:sanctum', 'checkRole:doctor,administrator'])->group(function() {
        Route::post('/agenda','App\Http\Controllers\ConsultController@store');
        Route::get('/agenda','App\Http\Controllers\ConsultController@index');
        Route::put('/agenda/{consult}','App\Http\Controllers\ConsultController@update');
        Route::delete('/agenda/{consult}', 'App\Http\Controllers\ConsultController@destroy');
});

Route::middleware(['auth:sanctum', 'checkRole:manager'])->group(function() {
        Route::post('/whitelist','App\Http\Controllers\WhitelistedEmailController@store');
        Route::get('/whitelist','App\Http\Controllers\WhitelistedEmailController@getAllWhitelistedEmails');
        Route::delete('/whitelist/{whitelist}', 'App\Http\Controllers\WhitelistedEmailController@destroy');
});

Route::middleware(['auth:sanctum', 'checkRole:doctor'])->group(function() {
        Route::post('/notes/grant','App\Http\Controllers\NoteController@GrantNoteAdministratorPermission');
});