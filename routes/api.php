<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiRequestController;

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

Route::prefix('dashboard/admin')->group(function () {
    Route::name('dashboard.')->group(function () {
        Route::controller(ApiRequestController::class)->group(function () {
            //WEB SERVICES
            Route::post('/hlgest',  'hlgestApi')->name('hlgest');
            Route::post('/primavera', 'primaveraApi')->name('primavera');
            Route::post('/phc', 'phcApi')->name('phc');
        });
    });
});
