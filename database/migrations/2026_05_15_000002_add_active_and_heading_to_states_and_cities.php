<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('states', function (Blueprint $table) {
            $table->string('heading')->nullable()->after('name');
            $table->boolean('is_active')->default(false)->after('content');
        });

        Schema::table('cities', function (Blueprint $table) {
            $table->string('heading')->nullable()->after('name');
            $table->boolean('is_active')->default(false)->after('content');
        });
    }

    public function down(): void
    {
        Schema::table('states', function (Blueprint $table) {
            $table->dropColumn(['heading', 'is_active']);
        });

        Schema::table('cities', function (Blueprint $table) {
            $table->dropColumn(['heading', 'is_active']);
        });
    }
};
