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
            $setting = Setting::where('key', '=', 'register_mail')->first();
            if (!$setting) {
                Setting::Create([
                    'key' => 'register_mail',
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
            $setting = Setting::where('key', '=', 'register_mail')->first();
            if (! $setting) {
                return;
            }
            $setting->delete();
        });
    }
};
