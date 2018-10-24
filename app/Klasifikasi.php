<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Klasifikasi extends Model
{
    protected $table = 'klasifikasi';

    protected $fillable = [
        'nama_klasifikasi'
    ];

    public function buku()
    {
        return $this->hasMany(Buku::class,'klasifikasi_id');
    }
}
