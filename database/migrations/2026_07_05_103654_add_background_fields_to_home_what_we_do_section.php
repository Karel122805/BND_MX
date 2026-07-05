<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('home_sections', function (Blueprint $table) {
            $table->foreignId('what_we_do_background_color_id')
                ->nullable()
                ->after('what_we_do_label_color_id')
                ->constrained('theme_colors')
                ->nullOnDelete();

            $table->boolean('what_we_do_use_gradient')
                ->default(false)
                ->after('what_we_do_background_color_id');

            $table->foreignId('what_we_do_gradient_from_color_id')
                ->nullable()
                ->after('what_we_do_use_gradient')
                ->constrained('theme_colors')
                ->nullOnDelete();

            $table->foreignId('what_we_do_gradient_to_color_id')
                ->nullable()
                ->after('what_we_do_gradient_from_color_id')
                ->constrained('theme_colors')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('home_sections', function (Blueprint $table) {
            $table->dropConstrainedForeignId('what_we_do_background_color_id');
            $table->dropColumn('what_we_do_use_gradient');
            $table->dropConstrainedForeignId('what_we_do_gradient_from_color_id');
            $table->dropConstrainedForeignId('what_we_do_gradient_to_color_id');
        });
    }
};