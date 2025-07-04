<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('season');
            $table->string('step_name');
            $table->date('date');
            $table->text('description');
            $table->integer('fertilizer_count')->default(0);
            $table->string('fertilizer_type')->nullable(); // e.g., 'Urea', 'N/A'
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
