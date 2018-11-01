<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'buku';

    protected $fillable = [
        'judul', 'pengarang_id',
        'penerbit_id', 'klasifikasi_id',
        'bahasa', 'edisi', 'isbn', 'deskripsi', 'stok'
    ];

    public function getUrlShowAttribute($value)
    {
        return route('buku.show',$this->id);
    }

    public function getUrlEditAttribute($value)
    {
        return route('buku.edit',$this->id);
    }

    public function getUrlUpdateAttribute($value)
    {
        return route('buku.update',$this->id);
    }

    public function getUrlDestroyAttribute($value)
    {
        return route('buku.destroy',$this->id);
    }

    public function klasifikasi()
    {
        return $this->belongsTo(Klasifikasi::class,'klasifikasi_id');
    }

    public function penerbit()
    {
        return $this->belongsTo(Penerbit::class, 'penerbit_id');
    }

    public function pengarang()
    {
        return $this->belongsTo(Pengarang::class,'pengarang_id');
    }
}
