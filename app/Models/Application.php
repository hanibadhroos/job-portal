<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $table = 'applications';
    protected $fillable = ['id','status','job_id','user_id','created_id','updated_at'];

    function job()
    {
        return $this->belongsTo(Job::class);
    }

    function user()
    {
        return $this->belongsTo(User::class);
    }
}
