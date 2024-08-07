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
        Setting::create([
            'key' => 'phonepe_merchant_id',
        ]);
        Setting::create([
            'key' => 'phonepe_merchant_user_id',
        ]);
        Setting::create([
            'key' => 'phonepe_env',
        ]);
        Setting::create([
            'key' => 'phonepe_salt_key',
        ]);
        Setting::create([
            'key' => 'phonepe_salt_index',
        ]);
        Setting::create([
            'key' => 'phonepe_merchant_transaction_id',
        ]);
    }
};
