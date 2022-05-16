<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignerTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id','date', 'signer', 'type_identity', 'number_identity', 'sign'
    ];
}
