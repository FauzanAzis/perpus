<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengarang extends Model
{
    protected $table = 'pengarang';

    protected $fillable = [
        'nama_pengarang', 'alamat_pengarang', 'telepon'
    ];

    public function setNamaPengarangAttribute($value)
    {
        return $this->attributes['nama_pengarang'] = strtoupper($value);
    }

    public function getUrlShowAttribute($value)
    {
        return route('pengarang.show',$this->id);
    }

    public function getUrlEditAttribute($value)
    {
        return route('pengarang.edit',$this->id);
    }

    public function getUrlUpdateAttribute($value)
    {
        return route('pengarang.update',$this->id);
    }

    public function getUrlDestroyAttribute($value)
    {
        return route('pengarang.destroy',$this->id);
    }

    public function buku()
    {
        return $this->hasMany(Buku::class, 'pengarang_id');
    }
}
