<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $setting = \App\Models\Setting::whereKey('affiliation_amount')->first();
        if ($setting) {
            return;
        }
        \App\Models\Setting::Create([
            'key' => 'affiliation_amount',
            'value' => '10',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
