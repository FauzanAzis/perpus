<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = 'anggota';

    protected $fillable = [
        'nama_anggota', 'jenis_kelamin', 'alamat'
    ];

    public function setNamaAnggotaAttribute($value)
    {
        return $this->attributes['nama_anggota'] = strtoupper($value);
    }

    public function getUrlShowAttribute($value)
    {
        return route('anggota.show',$this->id);
    }

    public function getUrlEditAttribute($value)
    {
        return route('anggota.edit',$this->id);
    }

    public function getUrlUpdateAttribute($value)
    {
        return route('anggota.update',$this->id);
    }

    public function getUrlDestroyAttribute($value)
    {
        return route('anggota.destroy',$this->id);
    }
}
