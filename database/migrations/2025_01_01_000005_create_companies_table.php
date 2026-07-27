<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('email')->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('website')->nullable();
            $table->string('address_line1')->nullable();
            $table->string('address_line2')->nullable();
            $table->string('city_name', 120)->nullable();
            $table->foreignId('state_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('country_id')->nullable()->constrained()->nullOnDelete();
            $table->string('zip', 20)->nullable();
            $table->longText('description')->nullable();
            $table->string('status')->default('pending'); // pending, approved, rejected
            $table->decimal('rating', 3, 1)->default(0);
            $table->string('logo')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('dot_number', 120)->nullable();
            $table->string('mc_number', 120)->nullable();
            $table->string('license_number', 120)->nullable();
            $table->string('service_type', 120)->nullable();
            $table->integer('years_in_business')->nullable();
            $table->integer('employees_count')->nullable();
            $table->json('services')->nullable();
            $table->json('service_areas')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_active')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_claimed')->default(false);
            $table->foreignId('claimed_by_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('subscription_plan')->default('free'); // free, basic, premium
            $table->timestamp('subscription_expires_at')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('companies'); }
};
