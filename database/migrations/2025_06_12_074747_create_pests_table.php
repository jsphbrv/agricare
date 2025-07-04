<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePestsTable extends Migration
{
    public function up()
    {
      Schema::create('pests', function (Blueprint $table) {
    $table->id();
    $table->string('crop');
    $table->string('common_name');
    $table->string('scientific_name');
    $table->foreignId('pesticide_id')->constrained()->onDelete('cascade');
    $table->timestamps();
});


    }

    public function down()
    {
        Schema::dropIfExists('pests');
    }
}
