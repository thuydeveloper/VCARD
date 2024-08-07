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

    Schema::table('privacy_policies', function (Blueprint $table) {
        $table->dropForeign(['vcard_id']);
        $table->foreign('vcard_id')->references('id')->on('vcards')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('privacy_policies', function (Blueprint $table) {
            $table->dropForeign(['vcard_id']);
            $table->foreign('vcard_id')->references('id')->on('vcards');
        });
    }
};
