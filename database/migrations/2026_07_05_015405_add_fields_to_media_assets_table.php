<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('media_assets', function (Blueprint $table) {
            $table->string('name')->nullable()->after('id');
            $table->string('key')->nullable()->after('name');
            $table->string('file')->nullable()->after('key');
            $table->string('alt')->nullable()->after('file');
            $table->boolean('is_active')->default(true)->after('alt');
        });
    }

    public function down(): void
    {
        Schema::table('media_assets', function (Blueprint $table) {
            $table->dropColumn([
                'name',
                'key',
                'file',
                'alt',
                'is_active',
            ]);
        });
    }
};