<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'job';
    protected $fillable=[
        'title','company_id','category_id','Requirments','Location','created_at'
    ];
    use HasFactory;
    function company()
    {
        return $this->belongsTo(Company::class);
    }

    function user()
    {
        return $this->hasMany(User::class);
    }

    function interview()
    {
        return $this->hasMany(Iterview::class);
    }
    function application()
    {
        return $this->hasMany(Application::class);
    }

    function category()
    {
        return $this->belongsTo(Category::class);
    }

}
