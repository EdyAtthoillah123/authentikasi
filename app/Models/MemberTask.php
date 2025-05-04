<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    // Model Task
    public function members()
    {
        return $this->belongsToMany(Member::class, 'member_task');
    }

    // Model Member
    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'member_task');
    }
}
