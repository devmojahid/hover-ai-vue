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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('stripe_plan_id')->nullable();
            $table->string('stripe_product_id')->nullable();
            $table->float('stripe_price')->nullable();
            $table->string('interval')->nullable();
            $table->integer('interval_count')->nullable();
            $table->integer('trial_period_days')->nullable();
            $table->boolean('is_active')->default(true);
            $table->float('credits')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};