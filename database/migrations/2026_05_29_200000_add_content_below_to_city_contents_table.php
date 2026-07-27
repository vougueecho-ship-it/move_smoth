<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('city_contents', function (Blueprint $table) {
            if (!Schema::hasColumn('city_contents', 'content_below')) {
                $table->longText('content_below')->nullable()->after('content');
            }
        });
    }

    public function down(): void
    {
        Schema::table('city_contents', function (Blueprint $table) {
            if (Schema::hasColumn('city_contents', 'content_below')) {
                $table->dropColumn('content_below');
            }
        });
    }
};
