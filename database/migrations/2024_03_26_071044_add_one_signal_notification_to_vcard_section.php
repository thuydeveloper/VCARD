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
        Schema::table('vcard_sections', function (Blueprint $table) {
            $table->string('one_signal_notification')->nullable()->after('appointments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vcard_sections', function (Blueprint $table) {
            $table->dropColumn('one_signal_notification');
        });
    }
};
