<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('planting_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // links to users table
            $table->string('step_name');        // e.g. 'Planting Seed', 'Lipat Tanim'
            $table->text('description')->nullable(); // optional description
            $table->date('date');               // when the activity happened
            $table->string('season')->nullable();    // optional: 'Dry Season 2025', etc.
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('planting_activities');
    }
};
