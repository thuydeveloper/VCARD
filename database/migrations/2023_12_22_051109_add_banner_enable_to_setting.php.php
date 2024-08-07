<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $setting = Setting::where('key', '=', 'banner_enable')->first();
            if (!$setting) {
                Setting::Create([
                    'key' => 'banner_enable',
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
            $setting = Setting::where('key', '=', 'banner_enable')->first();
            if (! $setting) {
                return;
            }
            $setting->delete();
        });
    }
};
