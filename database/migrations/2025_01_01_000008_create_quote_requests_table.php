<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('quote_requests', function (Blueprint $table) {
            $table->id();
            $table->string('zip_from');
            $table->string('zip_to');
            $table->date('move_date')->nullable();
            $table->string('move_size')->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('phone', 50)->nullable();
            $table->integer('calculated_distance')->nullable();
            $table->decimal('min_price', 10, 2)->nullable();
            $table->decimal('max_price', 10, 2)->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('quote_requests'); }
};
