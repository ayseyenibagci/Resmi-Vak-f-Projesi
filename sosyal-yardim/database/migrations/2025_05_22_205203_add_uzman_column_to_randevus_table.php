<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('randevus', function (Blueprint $table) {
            $table->string('uzman')->nullable()->after('uzman_id');
        });
    }

    public function down()
    {
        Schema::table('randevus', function (Blueprint $table) {
            $table->dropColumn('uzman');
        });
    }

};
