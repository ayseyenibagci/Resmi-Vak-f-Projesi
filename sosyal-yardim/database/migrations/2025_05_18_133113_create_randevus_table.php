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
        Schema::create('randevus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('ad');
            $table->string('soyad');
            $table->string('email');
            $table->string('telefon');
            $table->string('randevu_turu');
            $table->date('tarih');
            $table->time('saat');
            $table->text('aciklama')->nullable();

            $table->unsignedBigInteger('uzman_id'); // ilişki için
            $table->string('uzman'); // ad + soyad (görüntüleme için)

            $table->timestamps();
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
