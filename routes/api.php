<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\ItemController;

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

// 1. API login
Route::post('login', [AuthController::class, 'login']);

// 2. API daftar baru
Route::post('register', [AuthController::class, 'register']);

// Semua route dibawah ini memerlukan authentication
Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);

    // 3. API untuk membuat checklist
    Route::post('checklists', [ChecklistController::class, 'store']);

    // 4. API untuk menghapus checklist
    Route::delete('checklists/{id}', [ChecklistController::class, 'destroy']);

    // 5. API untuk menampilkan checklist-checklist yang sudah dibuat
    Route::get('checklists', [ChecklistController::class, 'index']);

    // 6. API Detail Checklist (Berisi item-item to-do yang sudah dibuat)
    Route::get('checklists/{id}', [ChecklistController::class, 'show']);

    // 7. API untuk membuat item-item to-do di dalam checklist
    Route::post('checklists/{checklist}/items', [ItemController::class, 'store']);

    // 8. API detail item
    Route::get('items/{id}', [ItemController::class, 'show']);

    // 9. API untuk mengubah item-item di dalam checklist
    Route::put('items/{id}', [ItemController::class, 'update']);

    // 10. API untuk mengubah status dari item di dalam checklist
    Route::patch('items/{id}/status', [ItemController::class, 'updateStatus']);

    // 11. API untuk menghapus item dari checklist
    Route::delete('items/{id}', [ItemController::class, 'destroy']);
});
