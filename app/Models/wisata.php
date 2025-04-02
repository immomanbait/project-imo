<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    use HasFactory;

    protected $table = 'wisata';
    protected $primaryKey = 'id_wisata';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'nama_wisata',
        'deskripsi',
        'alamat',
        'id_kategori',
        'lat',   // Latitude
        'long',  // Longitude
        'gambar_a',
        'gambar_b',
    ];

    protected $casts = [
        'lat' => 'float',
        'long' => 'float',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    public function ulasan()
    {
        return $this->hasMany(Ulasan::class, 'id_wisata', 'id_wisata');
    }
}
