<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;

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

Route::get('/', [ HomeController::class, "indexAction" ]);

Route::get('/{something}/{hash}', [ HomeController::class, "redirectSomethingHashAction" ]);
Route::get('/{hash}', [ HomeController::class, "redirectHashAction" ]);

Route::get('/{any?}', [ HomeController::class, "errorAction" ])->where('any', '.*');
