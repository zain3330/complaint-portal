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
        Schema::table('complaints', function (Blueprint $table) {
            $table->string('status')->default('In Progress'); // Status of the complaint (e.g., Open, In Progress, Resolved)
            $table->json('forward_history')->nullable(); // JSON field to store forward history
            $table->unsignedBigInteger('resolver_id')->nullable(); // The current resolver of the complaint (User ID)
            $table->unsignedBigInteger('resolved_by')->nullable(); // The user who resolved the complaint

            // Foreign key constraints (assuming you have a users table for resolvers)
            $table->foreign('resolver_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('resolved_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('forward_history');
            $table->dropForeign(['resolver_id']);
            $table->dropColumn('resolver_id');
            $table->dropForeign(['resolved_by']);
            $table->dropColumn('resolved_by');
        });
    }
};
