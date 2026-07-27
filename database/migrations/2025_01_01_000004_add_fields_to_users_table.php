<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_admin')->default(false)->after('password');
            $table->string('role')->default('customer')->after('is_admin'); // customer, company, admin
            $table->string('phone', 50)->nullable()->after('role');
            $table->string('avatar')->nullable()->after('phone');
        });
    }
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['is_admin', 'role', 'phone', 'avatar']);
        });
    }
};
