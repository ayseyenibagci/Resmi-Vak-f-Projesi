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
        Schema::create('randevular', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Randevuyu alan kullanıcı
            $table->string('yardim_turu');         // Yardım türü (örnek: Gıda Yardımı)
            $table->text('aciklama')->nullable();  // Açıklama (isteğe bağlı)
            $table->date('tarih');                 // Randevu tarihi
            $table->timestamps();

            // Kullanıcı ile ilişkilendir
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('randevular');
    }
};

