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
        Schema::table('nfc_orders', function (Blueprint $table) {
            $table->integer('quantity')->default(0)->after('order_status'); // Change the data type or default value as needed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nfc_orders', function (Blueprint $table) {
            $table->dropColumn('quantity');
        });
    }
};
