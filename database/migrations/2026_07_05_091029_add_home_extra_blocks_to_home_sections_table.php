<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('home_sections', function (Blueprint $table) {
            $table->string('what_we_do_title')->nullable();
            $table->text('what_we_do_content')->nullable();

            $table->string('what_card_1_title')->nullable();
            $table->text('what_card_1_content')->nullable();
            $table->string('what_card_1_icon')->nullable();
            $table->string('what_card_1_button_text')->nullable();
            $table->string('what_card_1_button_url')->nullable();

            $table->string('what_card_2_title')->nullable();
            $table->text('what_card_2_content')->nullable();
            $table->string('what_card_2_icon')->nullable();
            $table->string('what_card_2_button_text')->nullable();
            $table->string('what_card_2_button_url')->nullable();

            $table->string('what_card_3_title')->nullable();
            $table->text('what_card_3_content')->nullable();
            $table->string('what_card_3_icon')->nullable();
            $table->string('what_card_3_button_text')->nullable();
            $table->string('what_card_3_button_url')->nullable();

            $table->string('contact_cta_title')->nullable();
            $table->text('contact_cta_content')->nullable();
            $table->string('contact_cta_button_text')->nullable();
            $table->string('contact_cta_button_url')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('home_sections', function (Blueprint $table) {
            $table->dropColumn([
                'what_we_do_title',
                'what_we_do_content',

                'what_card_1_title',
                'what_card_1_content',
                'what_card_1_icon',
                'what_card_1_button_text',
                'what_card_1_button_url',

                'what_card_2_title',
                'what_card_2_content',
                'what_card_2_icon',
                'what_card_2_button_text',
                'what_card_2_button_url',

                'what_card_3_title',
                'what_card_3_content',
                'what_card_3_icon',
                'what_card_3_button_text',
                'what_card_3_button_url',

                'contact_cta_title',
                'contact_cta_content',
                'contact_cta_button_text',
                'contact_cta_button_url',
            ]);
        });
    }
};