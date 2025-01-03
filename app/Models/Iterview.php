<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iterview extends Model
{
    use HasFactory;

    protected $table='iterviews';
    protected $fillable=['details','job_id','user_id','interviewDate'];

    function user()
    {
        return $this->belongsTo(User::class);
    }

    function job()
    {
        return $this->belongsTo(Job::class);
    }
}
