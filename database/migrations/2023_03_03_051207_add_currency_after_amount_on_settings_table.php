<?php

use App\Models\Setting;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $setting = Setting::whereKey('currency_after_amount')->first();
        if ($setting) {
            return;
        }
        Setting::create([
            'key' => 'currency_after_amount',
            'value' => '0',
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
