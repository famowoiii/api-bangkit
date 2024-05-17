<?php
use App\Http\Controllers\Api\FranchiseController;
use App\Http\Controllers\AuthController;
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

// Rute untuk mendapatkan informasi pengguna terotentikasi
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Rute untuk menampilkan daftar franchise (bisa diakses oleh semua pengguna)
Route::get('franchise', [FranchiseController::class, 'index']);

// Grup middleware untuk melindungi operasi CRUD franchise, hanya bisa diakses oleh admin
Route::middleware(['auth:api', 'admin'])->group(function () {
    Route::post('franchise', [FranchiseController::class, 'store']);
    Route::put('franchise/{id}', [FranchiseController::class, 'update']);
    Route::delete('franchise/{id}', [FranchiseController::class, 'destroy']);
});

// Rute untuk autentikasi dan pengguna
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout']);

// Rute untuk mendapatkan informasi pengguna terotentikasi (hanya bisa diakses oleh pengguna terotentikasi)
Route::middleware('auth:api')->post('me', [AuthController::class, 'me']);
