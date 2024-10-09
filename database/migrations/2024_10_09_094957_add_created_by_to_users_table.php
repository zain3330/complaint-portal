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
            $table->unsignedBigInteger('created_by')->nullable()->after('id'); // Assuming 'id' is the first column
            // You may also want to add a foreign key constraint if necessary
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null'); // Adjust based on your needs
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['created_by']); // Drop foreign key if you added one
            $table->dropColumn('created_by'); // Remove the column
        });
    }
};
