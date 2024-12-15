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
        Schema::create('success_orders', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no')->index('invoice');
            $table->unsignedBigInteger('crew_id');
            $table->integer('total_amount');
            $table->integer('tender');
            $table->integer('change');
            $table->string('paymentMethod');
            $table->string('orderType');
            $table->boolean('isDiscounted')->default(false);
            $table->string('reference_number')->nullable();
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
        Schema::dropIfExists('success_orders');
    }
};
