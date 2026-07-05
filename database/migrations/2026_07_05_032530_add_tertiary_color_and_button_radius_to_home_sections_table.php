<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('home_sections', function (Blueprint $table) {
            $table->foreignId('tertiary_color_id')
                ->nullable()
                ->after('accent_color_id')
                ->constrained('theme_colors')
                ->nullOnDelete();

            $table->unsignedTinyInteger('primary_button_radius')
                ->default(6)
                ->after('primary_button_opacity');

            $table->unsignedTinyInteger('secondary_button_radius')
                ->default(6)
                ->after('secondary_button_opacity');
        });
    }

    public function down(): void
    {
        Schema::table('home_sections', function (Blueprint $table) {
            $table->dropConstrainedForeignId('tertiary_color_id');

            $table->dropColumn([
                'primary_button_radius',
                'secondary_button_radius',
            ]);
        });
    }
};