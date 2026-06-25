<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
{
    Schema::table('coupons', function (Blueprint $table) {
        $table->string('coupon_type')->default('SALE')->after('coupon_number');
        $table->string('reward_for_pic')->nullable()->after('owner_name');
    });
}

public function down(): void
{
    Schema::table('coupons', function (Blueprint $table) {
        $table->dropColumn(['coupon_type', 'reward_for_pic']);
    });
}

    /**
     * Reverse the migrations.
     */
    
};
