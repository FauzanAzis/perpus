<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengarang extends Model
{
    protected $table = 'pengarang';

    protected $fillable = [
        'nama_pengarang', 'alamat_pengarang', 'telepon'
    ];

    public function pengarang()
    {
        return $this->hasMany(Buku::class, 'pengarang_id');
    }
}
