<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\APIController;

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
    return $request->user();
});



Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::get('compose', [APIController::class, 'goToInvitationCompose'])->name('compose');
        
        
        Route::get('accepted/{email}', [APIController::class, 'showInvitations'])->name('accepted');
        Route::get('requested/{email}', [APIController::class, 'requestedInvitation'])->name('requested');    
        Route::get('delete/{id}', [APIController::class, 'destroy'])->name('delete');
        Route::get('accept/{id}', [APIController::class, 'acceptInvitation'])->name('accept');
        Route::post('send-data',[APIController::class, 'sendInvitation'])->name('send-data');
        
});


