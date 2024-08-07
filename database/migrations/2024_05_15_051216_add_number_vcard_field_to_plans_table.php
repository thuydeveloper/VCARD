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
        Schema::table('plans', function (Blueprint $table) {
         $table->boolean('custom_select')->default(0);
         $table->string('custom_vcard_number');
         $table->string('custom_vcard_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plans', function (Blueprint $table) {
         $table->dropColumn('custom_select');
         $table->dropColumn('custom_vcard_number');
         $table->dropColumn('custom_vcard_price');
        });
    }
};
