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
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('ingredient_categories');
            $table->string('ingredient_name');
            $table->integer('quantity');
            $table->string('measurement');
            $table->string('status');
            $table->string('manufactured_date');
            $table->string('expiration_date');
            $table->string('delivery_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredients');
    }
};
