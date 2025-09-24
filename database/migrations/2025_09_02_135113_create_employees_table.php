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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('nip', 20)->unique();
            $table->string('gender', 20);
            $table->string('place_of_birth', 200);
            $table->date('date_of_birth');
            $table->string('status', 10);
            $table->date('tmt_cpns');
            $table->string('no_karpeg', 100)->nullable();
            $table->foreignId('rank_id')->nullable()->constrained();
            $table->date('tmt_rank')->nullable();
            $table->integer('working_time_year')->nullable();
            $table->integer('working_time_month')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
