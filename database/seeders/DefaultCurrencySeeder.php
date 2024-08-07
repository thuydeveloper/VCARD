<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class DefaultCurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Setting::where('key', 'default_currency')->doesntExist()) {
            Setting::create(['key' => 'default_currency', 'value' => 'INR']);
        }
    }
}
