<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('home_sections', function (Blueprint $table) {
            $table->foreignId('background_media_asset_id')
                ->nullable()
                ->after('image')
                ->constrained('media_assets')
                ->nullOnDelete();

            $table->foreignId('text_color_id')
                ->nullable()
                ->after('background_media_asset_id')
                ->constrained('theme_colors')
                ->nullOnDelete();

            $table->foreignId('button_color_id')
                ->nullable()
                ->after('text_color_id')
                ->constrained('theme_colors')
                ->nullOnDelete();

            $table->foreignId('accent_color_id')
                ->nullable()
                ->after('button_color_id')
                ->constrained('theme_colors')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('home_sections', function (Blueprint $table) {
            $table->dropConstrainedForeignId('background_media_asset_id');
            $table->dropConstrainedForeignId('text_color_id');
            $table->dropConstrainedForeignId('button_color_id');
            $table->dropConstrainedForeignId('accent_color_id');
        });
    }
};