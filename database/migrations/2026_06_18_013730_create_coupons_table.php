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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();

            $table->string('coupon_number')->unique();
            $table->string('owner_name');

            $table->string('buyer_name')->nullable();
            $table->string('buyer_phone')->nullable();

            $table->integer('price')->default(100000);
            $table->integer('paid_amount')->default(0);

            $table->enum('payment_status', [
                'AVAILABLE',
                'UNPAID',
                'PARTIAL',
                'PAID',
                'WINNER',
                'CANCELLED'
            ])->default('AVAILABLE');

            $table->unsignedTinyInteger('payment_percent')->default(0);

            $table->string('input_by')->nullable();

            $table->timestamp('sold_at')->nullable();
            $table->text('note')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
