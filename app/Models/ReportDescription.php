<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportDescription extends Model
{
    use HasFactory;

    protected $table = "report_description";

    protected $fillable = [
        'report_id',
        'date',
        'descriptions',
    ];

    public function Report(){
    	return $this->belongsTo(Report::class);
    }
}
