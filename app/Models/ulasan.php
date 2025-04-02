<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;

    protected $table = 'ulasan';          // Nama tabel
    protected $primaryKey = 'id_ulasan';  // Primary key
    public $timestamps = false;           // Nonaktifkan timestamps
    public $incrementing = true;          // Aktifkan auto-increment

    // Kolom yang bisa diisi mass assignment
    protected $fillable = [
        'id_wisata',
        'komentar',
        'rating',
        'tanggal',
    ];

    // Relasi ke Wisata (Many to One)
    public function wisata()
    {
        return $this->belongsTo(Wisata::class, 'id_wisata', 'id_wisata');
    }
}
