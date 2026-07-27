<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Update top_movers table
        Schema::table('top_movers', function (Blueprint $table) {
            if (!Schema::hasColumn('top_movers', 'badge')) {
                $table->string('badge')->nullable()->after('company_id');
            }
            if (!Schema::hasColumn('top_movers', 'heading_1')) {
                $table->string('heading_1')->nullable()->after('badge');
            }
            if (!Schema::hasColumn('top_movers', 'heading_2')) {
                $table->string('heading_2')->nullable()->after('heading_1');
            }
            if (!Schema::hasColumn('top_movers', 'heading_3')) {
                $table->string('heading_3')->nullable()->after('heading_2');
            }
        });

        // 2. Update bottom_movers table
        Schema::table('bottom_movers', function (Blueprint $table) {
            if (!Schema::hasColumn('bottom_movers', 'content')) {
                $table->longText('content')->nullable()->after('company_id');
            }
        });

        // 3. Create pivot table top_mover_state
        if (!Schema::hasTable('top_mover_state')) {
            Schema::create('top_mover_state', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('top_mover_id');
                $table->unsignedBigInteger('state_id');
                $table->timestamps();

                $table->foreign('top_mover_id')->references('id')->on('top_movers')->onDelete('cascade');
                $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
            });
        }

        // 4. Create pivot table top_mover_city
        if (!Schema::hasTable('top_mover_city')) {
            Schema::create('top_mover_city', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('top_mover_id');
                $table->unsignedBigInteger('city_id');
                $table->timestamps();

                $table->foreign('top_mover_id')->references('id')->on('top_movers')->onDelete('cascade');
                $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            });
        }

        // 5. Create pivot table bottom_mover_state
        if (!Schema::hasTable('bottom_mover_state')) {
            Schema::create('bottom_mover_state', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('bottom_mover_id');
                $table->unsignedBigInteger('state_id');
                $table->timestamps();

                $table->foreign('bottom_mover_id')->references('id')->on('bottom_movers')->onDelete('cascade');
                $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
            });
        }

        // 6. Create pivot table bottom_mover_city
        if (!Schema::hasTable('bottom_mover_city')) {
            Schema::create('bottom_mover_city', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('bottom_mover_id');
                $table->unsignedBigInteger('city_id');
                $table->timestamps();

                $table->foreign('bottom_mover_id')->references('id')->on('bottom_movers')->onDelete('cascade');
                $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bottom_mover_city');
        Schema::dropIfExists('bottom_mover_state');
        Schema::dropIfExists('top_mover_city');
        Schema::dropIfExists('top_mover_state');

        Schema::table('bottom_movers', function (Blueprint $table) {
            $table->dropColumn('content');
        });

        Schema::table('top_movers', function (Blueprint $table) {
            $table->dropColumn(['badge', 'heading_1', 'heading_2', 'heading_3']);
        });
    }
};
