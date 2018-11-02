<?php

namespace App;

use App\Libraries\AutoNumber;
use Illuminate\Database\Eloquent\Model;

class Klasifikasi extends Model
{
    use AutoNumber;

    protected $table = 'klasifikasi';

    protected $fillable = [
        'nama_klasifikasi'
    ];

    public function buku()
    {
        return $this->hasMany(Buku::class,'klasifikasi_id');
    }

    public function setNamaKlasifikasiAttribute($value)
    {
        return $this->attributes['nama_klasifikasi'] = strtoupper($value);
    }

    public function getUrlShowAttribute($value)
    {
        return route('klasifikasi.show',$this->id);
    }

    public function getUrlEditAttribute($value)
    {
        return route('klasifikasi.edit',$this->id);
    }

    public function getUrlUpdateAttribute($value)
    {
        return route('klasifikasi.update',$this->id);
    }

    public function getUrlDestroyAttribute($value)
    {
        return route('klasifikasi.destroy',$this->id);
    }

    public function scopeBukuAda($query)
    {
        return $this->buku()->exists();
    }

    public static function boot()
    {
        parent::boot();

//        static::creating(function ($query){
//           $query->nomor = static::generateNumber(request()->nama_klasifikasi);
//        });
    }
}
