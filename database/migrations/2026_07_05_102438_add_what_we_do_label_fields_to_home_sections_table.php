<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('home_sections', function (Blueprint $table) {
            $table->string('what_we_do_label')->nullable()->after('what_we_do_content_color_id');

            $table->foreignId('what_we_do_label_color_id')
                ->nullable()
                ->after('what_we_do_label')
                ->constrained('theme_colors')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('home_sections', function (Blueprint $table) {
            $table->dropConstrainedForeignId('what_we_do_label_color_id');
            $table->dropColumn('what_we_do_label');
        });
    }
};