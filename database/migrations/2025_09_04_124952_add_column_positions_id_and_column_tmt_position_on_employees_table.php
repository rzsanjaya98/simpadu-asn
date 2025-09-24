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
            $table->foreignId('position_id')->nullable()->after('tmt_rank')->constrained('positions')->cascadeOnDelete();
            $table->date('tmt_position')->nullable()->after('tmt_rank');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['positions_id']);
            $table->dropColumn('positions_id');
            $table->dropColumn('tmt_position');
        });
    }
};
