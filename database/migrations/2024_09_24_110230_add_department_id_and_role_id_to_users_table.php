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
            // Add the new columns
            $table->unsignedBigInteger('department_id')->nullable()->after('password');
            $table->unsignedBigInteger('role_id')->nullable()->after('department_id');

            // Add foreign key constraints
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop foreign key constraints first
            $table->dropForeign(['department_id']);
            $table->dropForeign(['role_id']);

            // Drop the columns
            $table->dropColumn(['department_id', 'role_id']);
        });
    }
};
