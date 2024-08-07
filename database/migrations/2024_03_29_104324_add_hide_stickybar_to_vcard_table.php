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
        Schema::table('vcards', function (Blueprint $table) {
            $table->boolean('enable_affiliation')->after('language_enable')->default(false);
            $table->boolean('enable_contact')->after('language_enable')->default(true);
            $table->boolean('hide_stickybar')->after('language_enable')->default(false);
            $table->boolean('whatsapp_share')->after('language_enable')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vcards', function (Blueprint $table) {
            $table->dropColumn('enable_affiliation');
            $table->dropColumn('enable_contact');
            $table->dropColumn('hide_stickybar');
            $table->dropColumn('whatsapp_share');
        });
    }
};
