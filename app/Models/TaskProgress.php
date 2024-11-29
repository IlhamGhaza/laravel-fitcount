<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskProgress extends Model
{
    /** @use HasFactory<\Database\Factories\TaskProgressFactory> */
    use HasFactory,SoftDeletes;
    protected $fillable = ['user_id', 'task_name', 'description', 'status', 'priority'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
