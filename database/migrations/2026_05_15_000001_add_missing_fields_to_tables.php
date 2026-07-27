<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->boolean('is_featured')->default(false)->after('status');
        });

        Schema::table('cities', function (Blueprint $table) {
            $table->string('image')->nullable()->after('slug');
            $table->boolean('is_featured')->default(false)->after('image');
        });

        Schema::table('states', function (Blueprint $table) {
            $table->string('image')->nullable()->after('slug');
        });

        Schema::table('companies', function (Blueprint $table) {
            $table->string('seo_title')->nullable()->after('slug');
            $table->text('seo_description')->nullable()->after('seo_title');
        });
    }

    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropColumn('is_featured');
        });

        Schema::table('cities', function (Blueprint $table) {
            $table->dropColumn(['image', 'is_featured']);
        });

        Schema::table('states', function (Blueprint $table) {
            $table->dropColumn('image');
        });

        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn(['seo_title', 'seo_description']);
        });
    }
};
