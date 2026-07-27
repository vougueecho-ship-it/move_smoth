<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. ALIGN STATES
        Schema::table('states', function (Blueprint $table) {
            if (!Schema::hasColumn('states', 'slug')) $table->string('slug')->nullable()->unique();
            if (!Schema::hasColumn('states', 'meta_title')) $table->string('meta_title')->nullable();
            if (!Schema::hasColumn('states', 'meta_description')) $table->text('meta_description')->nullable();
            if (!Schema::hasColumn('states', 'heading')) $table->string('heading')->nullable();
            if (!Schema::hasColumn('states', 'content')) $table->longText('content')->nullable();
            if (!Schema::hasColumn('states', 'is_active')) $table->boolean('is_active')->default(true);
            if (Schema::hasColumn('states', 'image')) $table->dropColumn('image');
        });

        // 2. ALIGN CITIES
        Schema::table('cities', function (Blueprint $table) {
            if (!Schema::hasColumn('cities', 'slug')) $table->string('slug')->nullable()->unique();
            if (!Schema::hasColumn('cities', 'meta_title')) $table->string('meta_title')->nullable();
            if (!Schema::hasColumn('cities', 'meta_description')) $table->text('meta_description')->nullable();
            if (!Schema::hasColumn('cities', 'heading')) $table->string('heading')->nullable();
            if (!Schema::hasColumn('cities', 'content')) $table->longText('content')->nullable();
            if (!Schema::hasColumn('cities', 'is_active')) $table->boolean('is_active')->default(true);
            
            // Remove extra fields that are not in MoveEase
            $extras = ['image', 'is_featured', 'population', 'average_cost', 'best_time_to_move', 'quick_tips', 'faqs'];
            foreach ($extras as $extra) {
                if (Schema::hasColumn('cities', $extra)) $table->dropColumn($extra);
            }
        });

        // 3. ALIGN COMPANIES
        Schema::table('companies', function (Blueprint $table) {
            // Rename city_name to city to match MoveEase
            if (Schema::hasColumn('companies', 'city_name') && !Schema::hasColumn('companies', 'city')) {
                $table->renameColumn('city_name', 'city');
            } elseif (!Schema::hasColumn('companies', 'city')) {
                $table->string('city')->nullable();
            }

            if (!Schema::hasColumn('companies', 'website')) $table->string('website')->nullable();
            if (!Schema::hasColumn('companies', 'address_line1')) $table->string('address_line1')->nullable();
            if (!Schema::hasColumn('companies', 'address_line2')) $table->string('address_line2')->nullable();
            if (!Schema::hasColumn('companies', 'zip')) $table->string('zip')->nullable();
            
            // Fix: Update existing 'approved' to 'active' before changing to enum
            \Illuminate\Support\Facades\DB::table('companies')->where('status', 'approved')->update(['status' => 'active']);
            \Illuminate\Support\Facades\DB::table('companies')->where('status', 'rejected')->update(['status' => 'suspended']);

            // Adjust status enum to match MoveEase exactly
            $table->enum('status', ['active', 'pending', 'suspended'])->default('pending')->change();
            
            if (!Schema::hasColumn('companies', 'is_claimed')) $table->boolean('is_claimed')->default(false);
            if (!Schema::hasColumn('companies', 'claimed_by_user_id')) {
                $table->unsignedBigInteger('claimed_by_user_id')->nullable();
                $table->foreign('claimed_by_user_id')->references('id')->on('users')->onDelete('set null');
            }

            // Remove extra fields from MoveSmooth
            $extras = ['seo_title', 'seo_description', 'cover_image', 'years_in_business', 'employees_count', 'services', 'service_areas', 'is_verified', 'is_featured', 'subscription_plan', 'subscription_expires_at'];
            foreach ($extras as $extra) {
                if (Schema::hasColumn('companies', $extra)) $table->dropColumn($extra);
            }
        });

        // 4. ALIGN REVIEWS
        Schema::table('reviews', function (Blueprint $table) {
            if (!Schema::hasColumn('reviews', 'status')) {
                $table->enum('status', ['pending', 'approved', 'rejected'])->default('approved');
            } else {
                $table->enum('status', ['pending', 'approved', 'rejected'])->default('approved')->change();
            }
        });

        // 5. ALIGN BLOGS
        Schema::table('blogs', function (Blueprint $table) {
            if (!Schema::hasColumn('blogs', 'meta_keywords')) $table->string('meta_keywords')->nullable();
            if (!Schema::hasColumn('blogs', 'published_at')) $table->timestamp('published_at')->nullable();
        });
    }

    public function down(): void
    {
        // No down migration for a sync operation as it's destructive/reconstructive
    }
};
