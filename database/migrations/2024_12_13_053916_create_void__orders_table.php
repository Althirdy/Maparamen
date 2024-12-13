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
        Schema::create('void_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('meal_id');
            $table->unsignedBigInteger('crew_id');
            $table->integer('status')->default(1)->comment('1 = Voided || 2 = For Review');
            $table->timestamps();

            $table->foreign('crew_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('void__orders');
    }
};
