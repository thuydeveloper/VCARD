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
        $settings = [
            'website_link',
            'facebook_link',
            'youtube_link',
            'reddit_link',
            'whatsapp_link',
            'tiktok_link',
            'twitter_link',
            'instagram_link',
            'tumbir_link',
            'linkedin_link',
            'pinterest_link',
        ];

        foreach ($settings as $setting) {
            $settingExists = Setting::where('key', $setting)->exists();
            if (!$settingExists) {
                Setting::create(['key' => $setting]);
            }
        }
    }
};
