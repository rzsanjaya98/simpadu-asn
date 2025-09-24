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
        Schema::create('leave_approvals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('leave_request_id')->nullable()->constrained('leave_requests')->cascadeOnDelete();

            $table->foreignId('supervisor_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->enum('supervisor_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('supervisor_note')->nullable();

            $table->foreignId('leader_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->enum('leader_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('leader_note')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_approvals');
    }
};
