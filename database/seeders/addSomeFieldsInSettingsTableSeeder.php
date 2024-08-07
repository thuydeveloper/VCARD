<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class addSomeFieldsInSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Setting::Create(['key' => 'play_store_link', 'value' => '']);
                  Setting::Create(['key' => 'app_store_link', 'value' => '']);
                  Setting::Create([
                           'key' => 'mobile_app_enable',
                           'value' => 0,
                       ]);
    }
}
