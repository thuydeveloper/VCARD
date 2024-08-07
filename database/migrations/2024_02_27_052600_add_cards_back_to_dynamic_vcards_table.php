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
        Schema::table('dynamic_vcards', function (Blueprint $table) {
            $table->string('cards_back')->after('text_description_color');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dynamic_vcards', function (Blueprint $table) {
            $table->dropColumn('cards_back');
        });
    }
};
