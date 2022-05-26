<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Output extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'month', 
        'year',
        'tickets',
        'reports'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
