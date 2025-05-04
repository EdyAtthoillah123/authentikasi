<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Golongan extends Model
{
    /** @use HasFactory<\Database\Factories\GolonganFactory> */
    use HasFactory;

    protected $table = 'golongans';

    protected $primaryKey = 'id_Gol';

    public $incrementing = false;

    protected $fillable = [
        'id_Gol',
        'nama_Gol',
    ];

    public $timestamps = true;
}
