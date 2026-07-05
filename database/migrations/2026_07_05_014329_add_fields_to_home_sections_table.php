<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('home_sections', function (Blueprint $table) {
            $table->string('title')->nullable()->after('id');
            $table->string('subtitle')->nullable()->after('title');
            $table->longText('content')->nullable()->after('subtitle');
            $table->string('image')->nullable()->after('content');
            $table->integer('sort_order')->default(1)->after('image');
            $table->boolean('is_active')->default(true)->after('sort_order');
        });
    }

    public function down(): void
    {
        Schema::table('home_sections', function (Blueprint $table) {
            $table->dropColumn([
                'title',
                'subtitle',
                'content',
                'image',
                'sort_order',
                'is_active',
            ]);
        });
    }
};