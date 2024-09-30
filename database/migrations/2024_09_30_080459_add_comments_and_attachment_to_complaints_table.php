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
        Schema::table('complaints', function (Blueprint $table) {
            $table->text('comments')->nullable()->after('status');
            $table->string('attachment')->nullable()->after('comments');
        });
    }

    public function down()
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->dropColumn('comments');
            $table->dropColumn('attachment');
        });
    }

};
