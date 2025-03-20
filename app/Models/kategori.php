<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';          // Nama tabel
    protected $primaryKey = 'id_kategori';  // Primary key
    public $timestamps = false;             // Karena di tabel tidak ada kolom created_at & updated_at

    // Jika ingin bisa mass assignment (opsional, bisa diatur sesuai kebutuhan)
    protected $fillable = [
        'id_kategori',
        'nama_kategori',
    ];

    // Relasi ke tabel wisata (One to Many)
    public function wisata()
    {
        return $this->hasMany(Wisata::class, 'id_kategori', 'id_kategori');
    }
}
