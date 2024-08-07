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
        Schema::create('nfc_order_transaction', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nfc_order_id');
            $table->foreign('nfc_order_id')->references('id')->on('nfc_orders');
            $table->string('type');
            $table->string('transaction_id')->nullable();
            $table->integer('amount');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nfc_order_transaction');
    }
};
