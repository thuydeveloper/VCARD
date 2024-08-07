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
        $setting = Setting::whereKey('register_enable')->first();
        if ($setting) {
            return;
        }
        Setting::create([
            'key' => 'register_enable',
            'value' => '1',
        ]);
    }
};
