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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'perm_address_line2')) {
                $table->string('perm_address_line2')->nullable();
            }
            if (!Schema::hasColumn('users', 'religion')) {
                $table->string('religion')->nullable();
            }
            if (!Schema::hasColumn('users', 'civil_status')) {
                $table->string('civil_status')->nullable();
            }
            if (!Schema::hasColumn('users', 'name_of_spouse')) {
                $table->string('name_of_spouse')->nullable();
            }
            if (!Schema::hasColumn('users', 'highest_formal_education')) {
                $table->string('highest_formal_education')->nullable();
            }
            if (!Schema::hasColumn('users', 'nationality')) {
                $table->string('nationality')->nullable();
            }
            if (!Schema::hasColumn('users', 'profession')) {
                $table->string('profession')->nullable();
            }
            if (!Schema::hasColumn('users', 'source_of_funds')) {
                $table->string('source_of_funds')->nullable();
            }
            if (!Schema::hasColumn('users', 'mothers_maiden_name')) {
                $table->string('mothers_maiden_name')->nullable();
            }
            if (!Schema::hasColumn('users', 'emboss_name')) {
                $table->string('emboss_name')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'suffix',
                'perm_address_line2',
                'religion',
                'civil_status',
                'name_of_spouse',
                'highest_formal_education',
                'nationality',
                'profession',
                'source_of_funds',
                'mothers_maiden_name',
                'emboss_name',
            ]);
        });
    }
};
