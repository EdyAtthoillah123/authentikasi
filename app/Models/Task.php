<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class Task extends Model implements AuditableContract
{
    use HasFactory, SoftDeletes, Auditable; // Pastikan Auditable trait sudah ditambahkan

    protected $fillable = [
        'uuid', 'project_id', 'title', 'description', 'deadline', 'is_done', 'attachment',
    ];

    protected $casts = [
        'deadline' => 'datetime',
        'is_done' => 'boolean',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function members()
    {
        return $this->belongsToMany(Member::class, 'member_tasks');
    }
}
