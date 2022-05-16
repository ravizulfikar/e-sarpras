<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'token',
        'date',
        'source',
        'type',
        'location',
        'category',
        'detail',
        'status', 
        'verification'
    ];

    // protected $casts = [
    //     'location' => 'json',
    //     'detail' => 'json'
    // ];

    // public function category()
    // {
    //     return $this->belongsTo(Category::class, 'category');
    // }

    public function SignerTickets()
    {
        return $this->hasOne('App\Models\SignerTicket', 'ticket_id');
    }

    // public static function countByStatus($status){
    //     return Ticket::whereStatus($status)->get()->count();
    // }
    
}
