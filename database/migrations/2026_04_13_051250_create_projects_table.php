<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('client_name')->nullable();
            $table->text('description')->nullable();
            $table->decimal('hourly_rate', 8, 2)->default(0);
            $table->date('deadline')->nullable();
            $table->unsignedTinyInteger('completion_percentage')->default(0);
            $table->decimal('expected_hours', 6, 2)->nullable();
            $table->decimal('logged_hours', 6, 2)->default(0);
            $table->enum('status', ['open', 'in_progress', 'completed', 'on_hold', 'cancelled'])->default('open');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
