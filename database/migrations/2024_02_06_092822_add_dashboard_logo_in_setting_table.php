<?php

use App\Models\Setting;
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
        $appLogoUrl = ('/assets/images/infyom-logo60*60.png');

        Setting::create(['key' => 'dashboard_logo', 'value' => $appLogoUrl]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Setting::where('key', 'dashboard_logo')->delete();
    }
};
