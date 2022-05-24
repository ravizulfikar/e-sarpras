<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'month', 
        'year',
        'verification',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ReportDescription()
    {
        return $this->hasMany(ReportDescription::class);
    }

    public function getReportDescriptionAttribute()
    {
        $ReportDescription = $this->ReportDescription()->getQuery()->orderBy('date', 'ASC')->get();
        return $ReportDescription;
    }

    public function ReportPicture()
    {
        return $this->hasMany(ReportPicture::class);
    }

    public function getReportPictureAttribute()
    {
        $ReportPicture = $this->ReportPicture()->getQuery()->orderBy('date', 'ASC')->get();
        return $ReportPicture;
    }
}
