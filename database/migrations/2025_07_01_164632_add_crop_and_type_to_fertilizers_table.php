<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('fertilizers', function (Blueprint $table) {
        if (!Schema::hasColumn('fertilizers', 'crop')) {
            $table->string('crop')->after('description')->nullable();
        }
        if (!Schema::hasColumn('fertilizers', 'type')) {
            $table->string('type')->after('crop')->nullable();
        }
    });
}

public function down()
{
    Schema::table('fertilizers', function (Blueprint $table) {
        $table->dropColumn(['crop', 'type']);
    });
}

};
