<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    /** @use HasFactory<\Database\Factories\MahasiswaFactory> */
    use HasFactory;

    // Nama tabel
    protected $table = 'mahasiswas';

    // Kolom yang bisa diisi (mass-assignment)
    protected $fillable = [
        'NIM',
        'Nama',
        'Alamat',
        'Nohp',
        'Semester',
        'id_Gol',
    ];

    // Aktifkan timestamps (created_at dan updated_at)
    public $timestamps = true;

    // Relasi ke tabel golongan (jika ada)
    public function golongan()
    {
        return $this->belongsTo(Golongan::class, 'id_Gol');
    }
}
