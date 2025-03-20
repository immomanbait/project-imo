<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected  $guarded = ['id'];

    // Jika Anda ingin menambahkan relasi, Anda bisa melakukannya di sini
    // Contoh: relasi dengan User
 
}
