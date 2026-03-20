<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('ad')->nullable()->after('id');
            $table->string('soyad')->nullable()->after('ad');
            $table->string('telefon')->nullable()->after('email');
            $table->dropColumn('name');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['ad', 'soyad', 'telefon']);
            $table->string('name')->nullable(); // geri alırsan tekrar ekler
        });
    }

};
