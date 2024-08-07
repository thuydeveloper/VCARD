<?php

use App\Models\Language;
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
            $languageExists = Language::where('name', 'Italian')->exists();
            if (!$languageExists) {
                Language::create(['name' => 'Italian', 'iso_code' => 'it', 'is_default' => false, 'status' => true]);
            }
    }
};
