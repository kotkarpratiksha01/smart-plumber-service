<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('user')->after('email');
            $table->unsignedBigInteger('plumber_id')->nullable()->after('role');
            $table->foreign('plumber_id')->references('id')->on('plumbers')->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['plumber_id']);
            $table->dropColumn('plumber_id');
            $table->dropColumn('role');
        });
    }
};
