<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('home_sections', function (Blueprint $table) {
            $table->unsignedInteger('stat_1_number')->default(2433)->after('accent_color_id');
            $table->string('stat_1_label')->default('Pacientes')->after('stat_1_number');
            $table->foreignId('stat_1_color_id')->nullable()->after('stat_1_label')->constrained('theme_colors')->nullOnDelete();

            $table->unsignedInteger('stat_2_number')->default(149)->after('stat_1_color_id');
            $table->string('stat_2_label')->default('Estudios')->after('stat_2_number');
            $table->foreignId('stat_2_color_id')->nullable()->after('stat_2_label')->constrained('theme_colors')->nullOnDelete();

            $table->unsignedInteger('stat_3_number')->default(102)->after('stat_2_color_id');
            $table->string('stat_3_label')->default('Materiales')->after('stat_3_number');
            $table->foreignId('stat_3_color_id')->nullable()->after('stat_3_label')->constrained('theme_colors')->nullOnDelete();

            $table->unsignedInteger('stat_4_number')->default(15)->after('stat_3_color_id');
            $table->string('stat_4_label')->default('Donaciones')->after('stat_4_number');
            $table->foreignId('stat_4_color_id')->nullable()->after('stat_4_label')->constrained('theme_colors')->nullOnDelete();

            $table->string('primary_button_text')->default('Ver servicios')->after('stat_4_color_id');
            $table->string('primary_button_url')->default('/contacto')->after('primary_button_text');
            $table->foreignId('primary_button_color_id')->nullable()->after('primary_button_url')->constrained('theme_colors')->nullOnDelete();
            $table->foreignId('primary_button_text_color_id')->nullable()->after('primary_button_color_id')->constrained('theme_colors')->nullOnDelete();
            $table->foreignId('primary_button_hover_color_id')->nullable()->after('primary_button_text_color_id')->constrained('theme_colors')->nullOnDelete();
            $table->foreignId('primary_button_hover_text_color_id')->nullable()->after('primary_button_hover_color_id')->constrained('theme_colors')->nullOnDelete();
            $table->string('primary_button_icon')->nullable()->after('primary_button_hover_text_color_id');
            $table->foreignId('primary_button_icon_color_id')->nullable()->after('primary_button_icon')->constrained('theme_colors')->nullOnDelete();
            $table->foreignId('primary_button_hover_icon_color_id')->nullable()->after('primary_button_icon_color_id')->constrained('theme_colors')->nullOnDelete();

            $table->string('secondary_button_text')->default('Documentos')->after('primary_button_hover_icon_color_id');
            $table->string('secondary_button_url')->default('/documentos')->after('secondary_button_text');
            $table->foreignId('secondary_button_color_id')->nullable()->after('secondary_button_url')->constrained('theme_colors')->nullOnDelete();
            $table->foreignId('secondary_button_text_color_id')->nullable()->after('secondary_button_color_id')->constrained('theme_colors')->nullOnDelete();
            $table->foreignId('secondary_button_hover_color_id')->nullable()->after('secondary_button_text_color_id')->constrained('theme_colors')->nullOnDelete();
            $table->foreignId('secondary_button_hover_text_color_id')->nullable()->after('secondary_button_hover_color_id')->constrained('theme_colors')->nullOnDelete();
            $table->string('secondary_button_icon')->nullable()->after('secondary_button_hover_text_color_id');
            $table->foreignId('secondary_button_icon_color_id')->nullable()->after('secondary_button_icon')->constrained('theme_colors')->nullOnDelete();
            $table->foreignId('secondary_button_hover_icon_color_id')->nullable()->after('secondary_button_icon_color_id')->constrained('theme_colors')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('home_sections', function (Blueprint $table) {
            $table->dropConstrainedForeignId('secondary_button_hover_icon_color_id');
            $table->dropConstrainedForeignId('secondary_button_icon_color_id');
            $table->dropColumn('secondary_button_icon');
            $table->dropConstrainedForeignId('secondary_button_hover_text_color_id');
            $table->dropConstrainedForeignId('secondary_button_hover_color_id');
            $table->dropConstrainedForeignId('secondary_button_text_color_id');
            $table->dropConstrainedForeignId('secondary_button_color_id');
            $table->dropColumn(['secondary_button_url', 'secondary_button_text']);

            $table->dropConstrainedForeignId('primary_button_hover_icon_color_id');
            $table->dropConstrainedForeignId('primary_button_icon_color_id');
            $table->dropColumn('primary_button_icon');
            $table->dropConstrainedForeignId('primary_button_hover_text_color_id');
            $table->dropConstrainedForeignId('primary_button_hover_color_id');
            $table->dropConstrainedForeignId('primary_button_text_color_id');
            $table->dropConstrainedForeignId('primary_button_color_id');
            $table->dropColumn(['primary_button_url', 'primary_button_text']);

            $table->dropConstrainedForeignId('stat_4_color_id');
            $table->dropColumn(['stat_4_label', 'stat_4_number']);

            $table->dropConstrainedForeignId('stat_3_color_id');
            $table->dropColumn(['stat_3_label', 'stat_3_number']);

            $table->dropConstrainedForeignId('stat_2_color_id');
            $table->dropColumn(['stat_2_label', 'stat_2_number']);

            $table->dropConstrainedForeignId('stat_1_color_id');
            $table->dropColumn(['stat_1_label', 'stat_1_number']);
        });
    }
};