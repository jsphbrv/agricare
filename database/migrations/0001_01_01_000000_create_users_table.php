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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // Personal Info
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('suffix')->nullable(); // NEW
            $table->string('name')->nullable(); // Optional full name
            $table->enum('gender', ['Male', 'Female'])->nullable(); // You may rename this to 'sex' in code but keep 'gender' in DB for compatibility

            // Farmer-specific
            $table->string('rsbsa_ref_no')->nullable();
            $table->string('id_number')->nullable();
            $table->string('id_name')->nullable();
            $table->decimal('total_farm_area', 8, 2)->nullable(); // Hectares

            // Address
            $table->string('perm_address_street')->nullable();
            $table->string('perm_address_line2')->nullable(); // NEW
            $table->string('perm_address_barangay')->nullable();
            $table->string('perm_city')->default('Alcala');
            $table->string('perm_province')->default('Pangasinan');

            // Other Personal Details
            $table->date('birthdate')->nullable();
            $table->string('birthplace')->nullable();
            $table->string('religion')->nullable(); // NEW
            $table->string('civil_status')->nullable(); // NEW
            $table->string('name_of_spouse')->nullable(); // NEW
            $table->string('highest_formal_education')->nullable(); // NEW
            $table->string('nationality')->nullable();
            $table->string('profession')->nullable();
            $table->string('source_of_funds')->nullable();
            $table->string('mothers_maiden_name')->nullable();
            $table->string('emboss_name')->nullable();

            // Auth
            $table->string('mobile_number')->unique();
            $table->timestamp('mobile_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            // System Fields
            $table->string('role')->default('user');
            $table->string('status')->default('Active');

            $table->timestamps();
        });

        // Password Reset Table
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('mobile_number')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // Session Table
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};
