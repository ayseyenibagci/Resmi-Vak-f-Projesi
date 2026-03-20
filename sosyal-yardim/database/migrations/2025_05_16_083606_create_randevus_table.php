<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('randevus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // kullanıcıyla ilişki
            $table->string('yardim_turu');
            $table->string('uzman_adi');
            $table->date('tarih');
            $table->time('saat');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('randevus');
    }
};
