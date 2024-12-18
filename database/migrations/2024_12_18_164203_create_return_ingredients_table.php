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
        Schema::create('return_ingredients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->string('ingredient_name');
            $table->integer('quantity');
            $table->string('measurement');
            $table->date('return_date');
            $table->date('delivery_date');
            $table->string('return_reason');
            $table->string('remarks');
            $table->timestamps();

            $table->foreign('order_id')
                ->references('id')
                ->on('deliveries')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('return_ingredients');
    }
};
