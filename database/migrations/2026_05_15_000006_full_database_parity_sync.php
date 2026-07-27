<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. UPDATING REVIEWS TABLE
        Schema::table('reviews', function (Blueprint $table) {
            $cols = ['move_size', 'pickup_state_id', 'pickup_city', 'delivery_state_id', 'delivery_city', 'image1', 'image2', 'image3'];
            foreach ($cols as $col) {
                if (!Schema::hasColumn('reviews', $col)) {
                    if (str_ends_with($col, '_id')) {
                        $table->unsignedBigInteger($col)->nullable();
                    } else {
                        $table->string($col)->nullable();
                    }
                }
            }
        });

        // 2. CHECKLIST CATEGORIES
        if (!Schema::hasTable('checklist_categories')) {
            Schema::create('checklist_categories', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('slug')->unique();
                $table->text('description')->nullable();
                $table->timestamps();
            });
        }

        // 3. CHECKLIST ITEMS
        if (!Schema::hasTable('checklist_items')) {
            Schema::create('checklist_items', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('checklist_category_id');
                $table->string('title');
                $table->text('content')->nullable();
                $table->integer('order')->default(0);
                $table->timestamps();
                $table->foreign('checklist_category_id')->references('id')->on('checklist_categories')->onDelete('cascade');
            });
        }

        // 4. BLOG FAQS
        if (!Schema::hasTable('blog_faqs')) {
            Schema::create('blog_faqs', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('blog_id');
                $table->string('question');
                $table->text('answer');
                $table->integer('order')->default(0);
                $table->timestamps();
                $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');
            });
        }

        // 5. TOP MOVERS (Featured)
        if (!Schema::hasTable('top_movers')) {
            Schema::create('top_movers', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('company_id');
                $table->integer('order')->default(0);
                $table->timestamps();
                $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            });
        }

        // 6. BOTTOM MOVERS
        if (!Schema::hasTable('bottom_movers')) {
            Schema::create('bottom_movers', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('company_id');
                $table->integer('order')->default(0);
                $table->timestamps();
                $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            });
        }

        // 7. BEST MOVING PAGES (Custom Landing Pages)
        if (!Schema::hasTable('best_moving_pages')) {
            Schema::create('best_moving_pages', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('slug')->unique();
                $table->string('meta_title')->nullable();
                $table->text('meta_description')->nullable();
                $table->longText('content')->nullable();
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        // 8. STATE ROUTES
        if (!Schema::hasTable('state_routes')) {
            Schema::create('state_routes', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('from_state_id');
                $table->unsignedBigInteger('to_state_id');
                $table->string('title');
                $table->string('slug')->unique();
                $table->decimal('min_cost', 10, 2)->nullable();
                $table->decimal('max_cost', 10, 2)->nullable();
                $table->integer('miles')->nullable();
                $table->timestamps();
                $table->foreign('from_state_id')->references('id')->on('states')->onDelete('cascade');
                $table->foreign('to_state_id')->references('id')->on('states')->onDelete('cascade');
            });
        }

        // 9. CITY ROUTES
        if (!Schema::hasTable('city_routes')) {
            Schema::create('city_routes', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('from_city_id');
                $table->unsignedBigInteger('to_city_id');
                $table->string('title');
                $table->string('slug')->unique();
                $table->decimal('min_cost', 10, 2)->nullable();
                $table->decimal('max_cost', 10, 2)->nullable();
                $table->integer('miles')->nullable();
                $table->longText('content')->nullable();
                $table->string('meta_title')->nullable();
                $table->text('meta_description')->nullable();
                $table->string('meta_keywords')->nullable();
                $table->timestamps();
                // We don't add hard foreign keys here because city IDs might change during SQL import
            });
        }

        // 10. CONTACT MOVER LEADS
        if (!Schema::hasTable('contact_mover_leads')) {
            Schema::create('contact_mover_leads', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('company_id');
                $table->string('name');
                $table->string('email');
                $table->string('phone')->nullable();
                $table->string('move_from');
                $table->string('move_to');
                $table->date('move_date')->nullable();
                $table->string('move_size')->nullable();
                $table->text('message')->nullable();
                $table->timestamps();
                $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            });
        }

        // 11. COMPANY CLAIMS
        if (!Schema::hasTable('company_claims')) {
            Schema::create('company_claims', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('company_id');
                $table->unsignedBigInteger('user_id');
                $table->string('full_name');
                $table->string('work_email');
                $table->string('phone');
                $table->string('job_title');
                $table->text('additional_info')->nullable();
                $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
                $table->timestamps();
                $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });
        }
    }

    public function down(): void
    {
        // No down migration for parity sync as it's meant to reach a baseline
    }
};
