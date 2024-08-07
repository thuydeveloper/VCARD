<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $setting = Setting::where('key', '=', 'captcha_enable')->first();
            if (!$setting) {
                Setting::Create([
                    'key' => 'captcha_enable',
                    'value' => 0,
                ]);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $setting = Setting::where('key', '=', 'captcha_enable')->first();
            if (! $setting) {
                return;
            }
            $setting->delete();
        });
    }
};
