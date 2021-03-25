<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnsureTokenIsValid;
use Facade\FlareClient\Http\Response;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1'

], function ($router) {

    Route::post('login', [AuthController::class,'login'])->name('login');//'Api\AuthController@login'
    Route::post('logout', [AuthController::class,'logout'])->name('logout');//'Api\AuthController@logout'
});


Route::group([

    'middleware' => [EnsureTokenIsValid::class,'auth:api'],
    'prefix' => 'auth'

], function ($router) {
    Route::post('refresh',[AuthController::class,'refresh'])->name('refresh');// 'Api\AuthController@refresh'
    Route::post('me',[AuthController::class,'me'] )->name('me');//'Api\AuthController@me'

});


Route::fallback(function () {
    return response()->json(["serverResponse" => [
        "code" => 401,
        "message" => "Unauthorized User",
        "isSuccess" => false
    ],
    'token_invalid'=>true
    ]);
});
