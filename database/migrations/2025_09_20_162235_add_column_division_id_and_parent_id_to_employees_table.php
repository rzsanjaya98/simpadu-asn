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
        Schema::table('employees', function (Blueprint $table) {
            $table->foreignId('division_id')->after('position_id')->nullable()->constrained('divisions')->nullOnDelete();
            $table->foreignId('parent_id')->after('division_id')->nullable()->constrained('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['division_id']);
            $table->dropForeign(['parent_id']);
            $table->dropColumn('division_id');
            $table->dropColumn('parent_id');
        });
    }
};
