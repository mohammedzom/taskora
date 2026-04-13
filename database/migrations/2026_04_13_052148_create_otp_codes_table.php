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
        Schema::create('otp_codes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('identifier'); //  "email or phone"
            $table->string('code', 4);
            $table->enum('type', ['login_with_phone', 'login_with_email', 'forget_password', 'email_verification', 'phone_verification']);
            $table->timestamp('expires_at')->index();
            $table->boolean('is_used')->default(false);
            $table->timestamp('used_at')->nullable();
            $table->tinyInteger('attempts')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('otp_codes');
    }
};
