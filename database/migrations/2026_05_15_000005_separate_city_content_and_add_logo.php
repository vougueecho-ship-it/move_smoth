<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Create city_contents table for SEO and custom content
        Schema::create('city_contents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('city_id')->unique();
            $table->string('slug')->nullable()->unique();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('heading')->nullable();
            $table->longText('content')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            // We don't add foreign key yet because cities table might be dropped/recreated by the user's SQL
        });

        // 2. Add logo to companies
        Schema::table('companies', function (Blueprint $table) {
            if (!Schema::hasColumn('companies', 'logo')) {
                $table->string('logo')->nullable()->after('name');
            }
        });

        // 3. Move existing city content if any (optional but good practice)
        // Since this is a dev environment alignment, we'll skip complex data migration 
        // and just drop the columns from cities to allow the SQL import to work.
        
        Schema::table('cities', function (Blueprint $table) {
            $columns = ['slug', 'meta_title', 'meta_description', 'heading', 'content', 'is_active'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('cities', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('city_contents');
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('logo');
        });
    }
};
