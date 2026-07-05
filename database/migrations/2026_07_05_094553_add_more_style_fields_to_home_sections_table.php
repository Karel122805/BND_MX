<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('home_sections', function (Blueprint $table) {
            /*
            |--------------------------------------------------------------------------
            | Links de las tarjetas ¿Qué hacemos?
            |--------------------------------------------------------------------------
            */
            $table->foreignId('what_card_1_link_color_id')
                ->nullable()
                ->after('what_card_1_icon_background_color_id')
                ->constrained('theme_colors')
                ->nullOnDelete();

            $table->foreignId('what_card_2_link_color_id')
                ->nullable()
                ->after('what_card_2_icon_background_color_id')
                ->constrained('theme_colors')
                ->nullOnDelete();

            $table->foreignId('what_card_3_link_color_id')
                ->nullable()
                ->after('what_card_3_icon_background_color_id')
                ->constrained('theme_colors')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Cierre corto de contacto
            |--------------------------------------------------------------------------
            */
            $table->foreignId('contact_cta_background_color_id')
                ->nullable()
                ->after('contact_cta_button_url')
                ->constrained('theme_colors')
                ->nullOnDelete();

            $table->foreignId('contact_cta_gradient_from_color_id')
                ->nullable()
                ->after('contact_cta_background_color_id')
                ->constrained('theme_colors')
                ->nullOnDelete();

            $table->foreignId('contact_cta_gradient_to_color_id')
                ->nullable()
                ->after('contact_cta_gradient_from_color_id')
                ->constrained('theme_colors')
                ->nullOnDelete();

            $table->boolean('contact_cta_use_gradient')
                ->default(false)
                ->after('contact_cta_gradient_to_color_id');

            $table->foreignId('contact_cta_title_color_id')
                ->nullable()
                ->after('contact_cta_use_gradient')
                ->constrained('theme_colors')
                ->nullOnDelete();

            $table->foreignId('contact_cta_content_color_id')
                ->nullable()
                ->after('contact_cta_title_color_id')
                ->constrained('theme_colors')
                ->nullOnDelete();

            $table->foreignId('contact_cta_button_color_id')
                ->nullable()
                ->after('contact_cta_content_color_id')
                ->constrained('theme_colors')
                ->nullOnDelete();

            $table->foreignId('contact_cta_button_text_color_id')
                ->nullable()
                ->after('contact_cta_button_color_id')
                ->constrained('theme_colors')
                ->nullOnDelete();

            $table->string('contact_cta_button_icon')
                ->nullable()
                ->after('contact_cta_button_text_color_id');

            $table->foreignId('contact_cta_button_icon_color_id')
                ->nullable()
                ->after('contact_cta_button_icon')
                ->constrained('theme_colors')
                ->nullOnDelete();

            $table->foreignId('contact_cta_button_hover_color_id')
                ->nullable()
                ->after('contact_cta_button_icon_color_id')
                ->constrained('theme_colors')
                ->nullOnDelete();

            $table->foreignId('contact_cta_button_hover_text_color_id')
                ->nullable()
                ->after('contact_cta_button_hover_color_id')
                ->constrained('theme_colors')
                ->nullOnDelete();

            $table->foreignId('contact_cta_button_hover_icon_color_id')
                ->nullable()
                ->after('contact_cta_button_hover_text_color_id')
                ->constrained('theme_colors')
                ->nullOnDelete();

            $table->unsignedTinyInteger('contact_cta_button_radius')
                ->default(12)
                ->after('contact_cta_button_hover_icon_color_id');
        });
    }

    public function down(): void
    {
        Schema::table('home_sections', function (Blueprint $table) {
            $table->dropConstrainedForeignId('what_card_1_link_color_id');
            $table->dropConstrainedForeignId('what_card_2_link_color_id');
            $table->dropConstrainedForeignId('what_card_3_link_color_id');

            $table->dropConstrainedForeignId('contact_cta_background_color_id');
            $table->dropConstrainedForeignId('contact_cta_gradient_from_color_id');
            $table->dropConstrainedForeignId('contact_cta_gradient_to_color_id');

            $table->dropColumn('contact_cta_use_gradient');

            $table->dropConstrainedForeignId('contact_cta_title_color_id');
            $table->dropConstrainedForeignId('contact_cta_content_color_id');
            $table->dropConstrainedForeignId('contact_cta_button_color_id');
            $table->dropConstrainedForeignId('contact_cta_button_text_color_id');

            $table->dropColumn('contact_cta_button_icon');

            $table->dropConstrainedForeignId('contact_cta_button_icon_color_id');
            $table->dropConstrainedForeignId('contact_cta_button_hover_color_id');
            $table->dropConstrainedForeignId('contact_cta_button_hover_text_color_id');
            $table->dropConstrainedForeignId('contact_cta_button_hover_icon_color_id');

            $table->dropColumn('contact_cta_button_radius');
        });
    }
};