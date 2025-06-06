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
        Schema::create('success_order_meals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('success_order_id');
            $table->unsignedBigInteger('meal_id');
            $table->integer('quantity');
            $table->timestamps();

            $table->foreign('success_order_id')
                ->references('id')
                ->on('success_orders')
                ->onDelete('cascade');
            $table->foreign('meal_id')
                ->references('id')
                ->on('meals')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('success_order_meals');
    }
};
