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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->unsignedBigInteger('crew_id')->nullable();
            $table->string('ingredient_name');
            $table->integer('quantity');
            $table->string('measurement');
            $table->date('delivery_date');
            $table->date('manufactured_date')->nullable();
            $table->date('expiration_date')->nullable();
            $table->string('status')->default('To Receive');
            $table->timestamps();

            $table->foreign('crew_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};
