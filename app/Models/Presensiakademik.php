<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensiakademik extends Model
{
    /** @use HasFactory<\Database\Factories\PresensiakademikFactory> */
    use HasFactory;

    protected $table = 'presensiakademiks';

    protected $fillable = [
        'hari',
        'tanggal',
        'status_kehadiran',
        'NIM',
        'Kode_mk',
    ];

    public $timestamps = true;
}
