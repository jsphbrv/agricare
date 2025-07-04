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
    Schema::create('pesticides', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('crop');
        $table->string('used_for');
        $table->string('active_ingredient');
        $table->text('description');
        $table->string('image')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pesticides', function (Blueprint $table) {
            $table->dropColumn(['crop', 'used_for', 'active_ingredient']);
        });
    }
};
