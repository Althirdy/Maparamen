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
        Schema::table('bad_orders', function (Blueprint $table) {
            $table->unsignedBigInteger('meal_id')->after('crew_id');


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
        Schema::table('bad_orders', function (Blueprint $table) {
            $table->dropColumn('meal_id');
        });
    }
};
