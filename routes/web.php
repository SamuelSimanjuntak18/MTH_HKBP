<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RaffleController;

Route::get('/', [RaffleController::class, 'index'])->name('dashboard');

Route::post('/coupons', [RaffleController::class, 'storeCoupon'])->name('coupons.store');

Route::post('/coupons/generate', [RaffleController::class, 'generateCoupons'])->name('coupons.generate');

Route::post('/coupons/{coupon}/cancel', [RaffleController::class, 'cancelCoupon'])->name('coupons.cancel');

Route::post('/sales', [RaffleController::class, 'sellCoupon'])->name('sales.store');

Route::post('/draw', [RaffleController::class, 'draw'])->name('draw.store');

Route::post('/reset', [RaffleController::class, 'reset'])->name('reset');
Route::post('/coupons/{coupon}/update', [RaffleController::class, 'updateCoupon'])->name('coupons.update');

Route::post('/coupons/update-pic-range', [RaffleController::class, 'updatePicRange'])->name('coupons.updatePicRange');
