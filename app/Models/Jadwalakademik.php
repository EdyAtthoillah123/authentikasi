<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwalakademik extends Model
{
    /** @use HasFactory<\Database\Factories\JadwalakademikFactory> */
    use HasFactory;

    protected $table = 'jadwalakademiks';

    protected $fillable = [
        'hari',
        'Kode_mk',
        'id_Ruang',
        'id_Gol',
    ];

    public $timestamps = true;

    public function ruang()
    {
        return $this->belongsTo(Ruang::class, 'id_Ruang');
    }

    public function golongan()
    {
        return $this->belongsTo(Golongan::class, 'id_Gol');
    }
}
