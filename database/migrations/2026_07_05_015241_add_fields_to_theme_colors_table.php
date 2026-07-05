<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('theme_colors', function (Blueprint $table) {
            $table->string('name')->nullable()->after('id');
            $table->string('key')->nullable()->after('name');
            $table->string('hex')->nullable()->after('key');
            $table->boolean('is_active')->default(true)->after('hex');
        });
    }

    public function down(): void
    {
        Schema::table('theme_colors', function (Blueprint $table) {
            $table->dropColumn([
                'name',
                'key',
                'hex',
                'is_active',
            ]);
        });
    }
};