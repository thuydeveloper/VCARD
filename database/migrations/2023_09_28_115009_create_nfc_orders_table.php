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
        Schema::create('nfc_orders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('designation');
            $table->integer('phone');
            $table->string('email');
            $table->text('address');
            $table->string('company_name');
            $table->integer('order_status');
            $table->unsignedBigInteger('card_type');
            $table->foreign('card_type')->references('id')->on('nfcs');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('vcard_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('vcard_id')->references('id')->on('vcards')->onDelete('SET NULL');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nfc_orders');
    }
};
