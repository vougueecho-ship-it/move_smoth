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
        Schema::table('contact_mover_leads', function (Blueprint $table) {
            $table->string('num_rooms')->nullable()->after('move_size');
            $table->string('packing_service')->nullable()->after('num_rooms');
            $table->string('storage_option')->nullable()->after('packing_service');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact_mover_leads', function (Blueprint $table) {
            $table->dropColumn(['num_rooms', 'packing_service', 'storage_option']);
        });
    }
};
