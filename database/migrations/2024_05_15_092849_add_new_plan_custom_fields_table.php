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
         Schema::create('plan_custom_fields', function (Blueprint $table) {
                  $table->id();
                  $table->foreignId('plan_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
                  $table->string('custom_vcard_number');
                  $table->string('custom_vcard_price');
                  $table->timestamps();
                 });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
