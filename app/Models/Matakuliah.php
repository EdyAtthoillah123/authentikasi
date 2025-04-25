<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    /** @use HasFactory<\Database\Factories\MatakuliahFactory> */
    use HasFactory;

    // Nama tabel di database
    protected $table = 'matakuliahs';

    // Kolom yang bisa diisi secara mass-assignment
    protected $fillable = [
        'Kode_mk',
        'Nama_mk',
        'Sks',
        'Semester',
    ];

    // Aktifkan timestamps (created_at & updated_at)
    public $timestamps = true;
}
