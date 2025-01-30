<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobAlertSubscription extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'categories','location','job_type'];

    // protected $casts = [
    //     'categories' => 'array', // تحويل البيانات تلقائياً إلى Array عند استرجاعها
    // ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
