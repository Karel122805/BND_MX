<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('home_sections', function (Blueprint $table) {
            $table->foreignId('stat_1_label_color_id')
                ->nullable()
                ->after('stat_1_color_id')
                ->constrained('theme_colors')
                ->nullOnDelete();

            $table->foreignId('stat_2_label_color_id')
                ->nullable()
                ->after('stat_2_color_id')
                ->constrained('theme_colors')
                ->nullOnDelete();

            $table->foreignId('stat_3_label_color_id')
                ->nullable()
                ->after('stat_3_color_id')
                ->constrained('theme_colors')
                ->nullOnDelete();

            $table->foreignId('stat_4_label_color_id')
                ->nullable()
                ->after('stat_4_color_id')
                ->constrained('theme_colors')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('home_sections', function (Blueprint $table) {
            $table->dropConstrainedForeignId('stat_1_label_color_id');
            $table->dropConstrainedForeignId('stat_2_label_color_id');
            $table->dropConstrainedForeignId('stat_3_label_color_id');
            $table->dropConstrainedForeignId('stat_4_label_color_id');
        });
    }
};