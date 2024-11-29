<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BmiRecord extends Model
{
    /** @use HasFactory<\Database\Factories\BmiRecordFactory> */
    use HasFactory,SoftDeletes;
    protected $fillable = ['user_id', 'bmi_score', 'bmi_category'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
