<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('home_sections', function (Blueprint $table) {
            $table->foreignId('what_we_do_title_color_id')
                ->nullable()
                ->after('what_we_do_title')
                ->constrained('theme_colors')
                ->nullOnDelete();

            $table->foreignId('what_we_do_content_color_id')
                ->nullable()
                ->after('what_we_do_content')
                ->constrained('theme_colors')
                ->nullOnDelete();

            $table->foreignId('what_card_1_background_color_id')
                ->nullable()
                ->after('what_card_1_button_url')
                ->constrained('theme_colors')
                ->nullOnDelete();

            $table->foreignId('what_card_1_title_color_id')
                ->nullable()
                ->after('what_card_1_background_color_id')
                ->constrained('theme_colors')
                ->nullOnDelete();

            $table->foreignId('what_card_1_content_color_id')
                ->nullable()
                ->after('what_card_1_title_color_id')
                ->constrained('theme_colors')
                ->nullOnDelete();

            $table->foreignId('what_card_1_icon_color_id')
                ->nullable()
                ->after('what_card_1_content_color_id')
                ->constrained('theme_colors')
                ->nullOnDelete();

            $table->foreignId('what_card_1_icon_background_color_id')
                ->nullable()
                ->after('what_card_1_icon_color_id')
                ->constrained('theme_colors')
                ->nullOnDelete();

            $table->foreignId('what_card_2_background_color_id')
                ->nullable()
                ->after('what_card_2_button_url')
                ->constrained('theme_colors')
                ->nullOnDelete();

            $table->foreignId('what_card_2_title_color_id')
                ->nullable()
                ->after('what_card_2_background_color_id')
                ->constrained('theme_colors')
                ->nullOnDelete();

            $table->foreignId('what_card_2_content_color_id')
                ->nullable()
                ->after('what_card_2_title_color_id')
                ->constrained('theme_colors')
                ->nullOnDelete();

            $table->foreignId('what_card_2_icon_color_id')
                ->nullable()
                ->after('what_card_2_content_color_id')
                ->constrained('theme_colors')
                ->nullOnDelete();

            $table->foreignId('what_card_2_icon_background_color_id')
                ->nullable()
                ->after('what_card_2_icon_color_id')
                ->constrained('theme_colors')
                ->nullOnDelete();

            $table->foreignId('what_card_3_background_color_id')
                ->nullable()
                ->after('what_card_3_button_url')
                ->constrained('theme_colors')
                ->nullOnDelete();

            $table->foreignId('what_card_3_title_color_id')
                ->nullable()
                ->after('what_card_3_background_color_id')
                ->constrained('theme_colors')
                ->nullOnDelete();

            $table->foreignId('what_card_3_content_color_id')
                ->nullable()
                ->after('what_card_3_title_color_id')
                ->constrained('theme_colors')
                ->nullOnDelete();

            $table->foreignId('what_card_3_icon_color_id')
                ->nullable()
                ->after('what_card_3_content_color_id')
                ->constrained('theme_colors')
                ->nullOnDelete();

            $table->foreignId('what_card_3_icon_background_color_id')
                ->nullable()
                ->after('what_card_3_icon_color_id')
                ->constrained('theme_colors')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('home_sections', function (Blueprint $table) {
            $table->dropConstrainedForeignId('what_we_do_title_color_id');
            $table->dropConstrainedForeignId('what_we_do_content_color_id');

            $table->dropConstrainedForeignId('what_card_1_background_color_id');
            $table->dropConstrainedForeignId('what_card_1_title_color_id');
            $table->dropConstrainedForeignId('what_card_1_content_color_id');
            $table->dropConstrainedForeignId('what_card_1_icon_color_id');
            $table->dropConstrainedForeignId('what_card_1_icon_background_color_id');

            $table->dropConstrainedForeignId('what_card_2_background_color_id');
            $table->dropConstrainedForeignId('what_card_2_title_color_id');
            $table->dropConstrainedForeignId('what_card_2_content_color_id');
            $table->dropConstrainedForeignId('what_card_2_icon_color_id');
            $table->dropConstrainedForeignId('what_card_2_icon_background_color_id');

            $table->dropConstrainedForeignId('what_card_3_background_color_id');
            $table->dropConstrainedForeignId('what_card_3_title_color_id');
            $table->dropConstrainedForeignId('what_card_3_content_color_id');
            $table->dropConstrainedForeignId('what_card_3_icon_color_id');
            $table->dropConstrainedForeignId('what_card_3_icon_background_color_id');
        });
    }
};