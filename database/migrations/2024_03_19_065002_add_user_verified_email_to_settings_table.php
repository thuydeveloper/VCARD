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
        $setting = Setting::whereKey('user_verified_email')->first();
        if ($setting) {
            return;
        }
        Setting::create([
            'key' => 'user_verified_email',
            'value' => '1',
        ]);
    }

    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('user_verified_email');
        });
    }
};
