<?php

use Illuminate\Http\Request;
use app\Http\Controllers;



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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/v1/nearPharmacies', 'v1\PharmacyController@displayNearestPharms');
Route::resource('/v1/pharmacies',v1\PharmacyController::class, [
    'except' => ['create', 'edit']
]);