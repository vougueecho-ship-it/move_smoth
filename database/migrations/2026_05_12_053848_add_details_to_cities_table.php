<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cities', function (Blueprint $table) {
            $table->string('average_cost')->nullable();
            $table->string('best_time_to_move')->nullable();
            $table->json('quick_tips')->nullable();
            $table->json('faqs')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('cities', function (Blueprint $table) {
            $table->dropColumn(['average_cost', 'best_time_to_move', 'quick_tips', 'faqs']);
        });
    }
};
