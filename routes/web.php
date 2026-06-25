<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RaffleController;
use Illuminate\Support\Facades\Route;

Route::get('/', [RaffleController::class, 'publicWinners'])->name('public.winners');
Route::get('/winners', [RaffleController::class, 'publicWinners'])->name('public.winners');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [RaffleController::class, 'index'])->name('dashboard');

    Route::post('/coupons', [RaffleController::class, 'storeCoupon'])->name('coupons.store');
    Route::post('/coupons/generate', [RaffleController::class, 'generateCoupons'])->name('coupons.generate');
    Route::post('/coupons/{coupon}/update', [RaffleController::class, 'updateCoupon'])->name('coupons.update');
    Route::post('/coupons/{coupon}/cancel', [RaffleController::class, 'cancelCoupon'])->name('coupons.cancel');
    Route::post('/coupons/update-pic-range', [RaffleController::class, 'updatePicRange'])->name('coupons.updatePicRange');

    Route::post('/sales', [RaffleController::class, 'sellCoupon'])->name('sales.store');
    Route::post('/draw', [RaffleController::class, 'draw'])->name('draw.store');
    Route::post('/reset', [RaffleController::class, 'reset'])->name('reset');
    Route::post('/pics', [RaffleController::class, 'storePic'])->name('pics.store');
Route::post('/pics/{pic}/update', [RaffleController::class, 'updatePic'])->name('pics.update');
Route::post('/pics/{pic}/toggle', [RaffleController::class, 'togglePic'])->name('pics.toggle');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/coupons/generate-reward', [RaffleController::class, 'generateRewardCoupons'])->name('coupons.generateReward');
});

require __DIR__.'/auth.php';
