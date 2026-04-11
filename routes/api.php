<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\FixedAssetController;
use App\Http\Controllers\Api\AssetMutationController;
use App\Http\Controllers\Api\AssetDisposalController;
use App\Http\Controllers\Api\StockOpnameController;
use App\Http\Controllers\Api\BorrowingController;
use App\Http\Controllers\Api\ConsumableController;
use App\Http\Controllers\Api\ConsumableInboundController;
use App\Http\Controllers\Api\ConsumableOutboundController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    // master data
    Route::apiResource('locations', LocationController::class);
    Route::apiResource('suppliers', SupplierController::class);
    // transaksi aset tetap
    Route::apiResource('fixed-assets', FixedAssetController::class);
    // Mutasi Aset
    Route::get('asset-mutations', [AssetMutationController::class, 'index']);
    Route::post('asset-mutations', [AssetMutationController::class, 'store']);
    Route::get('asset-mutations/{assetMutation}', [AssetMutationController::class, 'show']);
    // Stock Opname
    Route::get('stock-opnames', [StockOpnameController::class, 'index']);
    Route::post('stock-opnames', [StockOpnameController::class, 'store']);
    Route::get('stock-opnames/{stockOpname}', [StockOpnameController::class, 'show']);
    // Disposal Aset
    Route::get('asset-disposals', [AssetDisposalController::class, 'index']);
    Route::post('asset-disposals', [AssetDisposalController::class, 'store']);
    Route::get('asset-disposals/{assetDisposal}', [AssetDisposalController::class, 'show']);
    // Peminjaman Aset
    Route::get('borrowings', [BorrowingController::class, 'index']);
    Route::post('borrowings', [BorrowingController::class, 'store']);
    Route::get('borrowings/{borrowing}', [BorrowingController::class, 'show']);
    Route::patch('borrowings/{borrowing}/return', [BorrowingController::class, 'returnAsset']);
    // transaksi barang habis pakai
    Route::apiResource('consumables', ConsumableController::class);
    // Barang Masuk
    Route::get('consumable-inbounds', [ConsumableInboundController::class, 'index']);
    Route::post('consumable-inbounds', [ConsumableInboundController::class, 'store']);
    Route::get('consumable-inbounds/{consumableInbound}', [ConsumableInboundController::class, 'show']);
    Route::delete('consumable-inbounds/{consumableInbound}', [ConsumableInboundController::class, 'destroy']);
    // Barang Keluar
    Route::get('consumable-outbounds', [ConsumableOutboundController::class, 'index']);
    Route::post('consumable-outbounds', [ConsumableOutboundController::class, 'store']);
    Route::get('consumable-outbounds/{consumableOutbound}', [ConsumableOutboundController::class, 'show']);
    Route::delete('consumable-outbounds/{consumableOutbound}', [ConsumableOutboundController::class, 'destroy']);
});
