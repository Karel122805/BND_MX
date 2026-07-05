<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('home_sections', function (Blueprint $table) {
            $table->string('title_part_1')->nullable()->after('title');
            $table->foreignId('title_part_1_color_id')->nullable()->after('title_part_1')->constrained('theme_colors')->nullOnDelete();

            $table->string('title_part_2')->nullable()->after('title_part_1_color_id');
            $table->foreignId('title_part_2_color_id')->nullable()->after('title_part_2')->constrained('theme_colors')->nullOnDelete();

            $table->string('title_part_3')->nullable()->after('title_part_2_color_id');
            $table->foreignId('title_part_3_color_id')->nullable()->after('title_part_3')->constrained('theme_colors')->nullOnDelete();

            $table->foreignId('subtitle_text_color_id')->nullable()->after('tertiary_color_id')->constrained('theme_colors')->nullOnDelete();
            $table->foreignId('subtitle_border_color_id')->nullable()->after('subtitle_text_color_id')->constrained('theme_colors')->nullOnDelete();
            $table->foreignId('subtitle_background_color_id')->nullable()->after('subtitle_border_color_id')->constrained('theme_colors')->nullOnDelete();

            $table->unsignedTinyInteger('subtitle_background_opacity')
                ->default(20)
                ->after('subtitle_background_color_id');
        });
    }

    public function down(): void
    {
        Schema::table('home_sections', function (Blueprint $table) {
            $table->dropColumn('subtitle_background_opacity');

            $table->dropConstrainedForeignId('subtitle_background_color_id');
            $table->dropConstrainedForeignId('subtitle_border_color_id');
            $table->dropConstrainedForeignId('subtitle_text_color_id');

            $table->dropConstrainedForeignId('title_part_3_color_id');
            $table->dropColumn('title_part_3');

            $table->dropConstrainedForeignId('title_part_2_color_id');
            $table->dropColumn('title_part_2');

            $table->dropConstrainedForeignId('title_part_1_color_id');
            $table->dropColumn('title_part_1');
        });
    }
};