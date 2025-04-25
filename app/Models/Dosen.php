<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    /** @use HasFactory<\Database\Factories\DosenFactory> */
    use HasFactory;

    protected $table = 'dosens';

    protected $fillable = [
        'NIP',
        'Nama',
        'Alamat',
        'Nohp',
    ];

    public $timestamps = true;
}
