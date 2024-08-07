<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $setting = \App\Models\Setting::where('key', '=', 'paypal_mode')->first();
        if ($setting) {
            return;
        }
        \App\Models\Setting::Create([
            'key' => 'paypal_mode',
            'value' => 'sandbox',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $setting = \App\Models\Setting::where('key', '=', 'paypal_mode')->first();
        if (! $setting) {
            return;
        }
        $setting->delete();
    }
};
