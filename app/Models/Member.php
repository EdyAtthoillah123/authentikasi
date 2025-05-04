<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Member extends Model implements AuditableContract
{
    use Auditable, HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid', 'name', 'email', 'joined_at', 'is_admin', 'extra_info', 'role',
    ];

    protected $casts = [
        'joined_at' => 'datetime',
        'is_admin' => 'boolean',
        'extra_info' => 'array',
    ];

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'member_project');
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'member_task');
    }

    public function isAdmin()
    {
        return $this->role == 'admin';
    }

    public function isManager()
    {
        return $this->role == 'manager';
    }

    public function isMember()
    {
        return $this->role == 'member';
    }
}
