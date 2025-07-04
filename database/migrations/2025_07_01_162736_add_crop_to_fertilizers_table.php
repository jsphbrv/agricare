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
    Schema::table('fertilizers', function (Blueprint $table) {
        $table->string('crop')->after('description');
        $table->string('type')->nullable()->after('crop');
    });
}

public function down(): void
{
    Schema::table('fertilizers', function (Blueprint $table) {
        $table->dropColumn('type');
        $table->dropColumn('crop');
    });
}

};
