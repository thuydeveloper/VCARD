<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class FrontPageDisableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $frontPageEnableExist = Setting::where('key', 'is_front_page')->exists();

        if (! $frontPageEnableExist) {
            Setting::create(['key' => 'is_front_page', 'value' => '1']);
        }
    }
}
