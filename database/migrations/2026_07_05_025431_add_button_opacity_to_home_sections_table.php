<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('home_sections', function (Blueprint $table) {
            $table->unsignedTinyInteger('primary_button_opacity')
                ->default(100)
                ->after('primary_button_color_id');

            $table->unsignedTinyInteger('secondary_button_opacity')
                ->default(15)
                ->after('secondary_button_color_id');
        });
    }

    public function down(): void
    {
        Schema::table('home_sections', function (Blueprint $table) {
            $table->dropColumn([
                'primary_button_opacity',
                'secondary_button_opacity',
            ]);
        });
    }
};