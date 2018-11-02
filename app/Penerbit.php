<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penerbit extends Model
{
    protected $table = 'penerbit';

    protected $fillable = [
        'nama_penerbit', 'alamat_penerbit'
    ];

    public function buku()
    {
        return $this->hasMany(Buku::class, 'penerbit_id');
    }

    public function setNamaPenerbitAttribute($value)
    {
        return $this->attributes['nama_penerbit'] = strtoupper($value);
    }

    public function getUrlShowAttribute($value)
    {
        return route('penerbit.show',$this->id);
    }

    public function getUrlEditAttribute($value)
    {
        return route('penerbit.edit',$this->id);
    }

    public function getUrlUpdateAttribute($value)
    {
        return route('penerbit.update',$this->id);
    }

    public function getUrlDestroyAttribute($value)
    {
        return route('penerbit.destroy',$this->id);
    }

    public function scopeBukuAda($query)
    {
        return $this->buku()->exists();
    }
}
