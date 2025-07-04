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
    Schema::table('planting_activities', function (Blueprint $table) {
        $table->integer('fertilizer_count')->default(0);
        $table->string('fertilizer_type')->nullable();
    });
}

public function down(): void
{
    Schema::table('planting_activities', function (Blueprint $table) {
        $table->dropColumn(['fertilizer_count', 'fertilizer_type']);
    });
}

};
