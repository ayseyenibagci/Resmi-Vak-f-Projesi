<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Randevu extends Model
{
    protected $fillable = [
        'user_id',
        'ad',
        'soyad',
        'email',
        'telefon',
        'randevu_turu',
        'tarih',
        'saat',
        'aciklama',
        'uzman_id',
        'uzman',
    ];


    public function uzman()
    {
        return $this->belongsTo(User::class, 'uzman_id');
    }

}

