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
            $table->string('insta_embed')->nullable()->after('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vcard_sections', function (Blueprint $table) {
            $table->dropColumn('insta_embed');
        });
    }
};