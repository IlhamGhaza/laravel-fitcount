<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory, SoftDeletes;


    protected $fillable = ['user_id', 'task_name', 'description', 'status', 'priority'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function taskProgress()
    {
        return $this->hasMany(TaskProgress::class);
    }


    public function isComplete()
    {
        return $this->status === 'completed';
    }
}
