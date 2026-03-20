<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('randevus', function (Blueprint $table) {
            $table->unsignedBigInteger('uzman_id')->after('telefon')->nullable();
            $table->foreign('uzman_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('randevus', function (Blueprint $table) {
            $table->dropForeign(['uzman_id']);
            $table->dropColumn('uzman_id');
        });
    }

};
