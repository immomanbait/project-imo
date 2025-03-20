<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    use HasFactory;

    protected $table = 'wisata';            // Nama tabel
    protected $primaryKey = 'id_wisata';    // Primary key
    public $timestamps = false;             // Karena tabel tidak memiliki created_at & updated_at

    // Kolom yang bisa diisi (opsional, sesuai kebutuhan)
    protected $fillable = [
        'id_wisata',
        'nama_wisata',
        'deskripsi',
        'alamat',
        'id_kategori',
        'lat',
        'long',
    ];

    // Relasi ke kategori (Many to One)
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    // Relasi ke ulasan (One to Many)
    public function ulasan()
    {
        return $this->hasMany(Ulasan::class, 'id_wisata', 'id_wisata');
    }
}
