<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $fillable = [
        'level',
        'code',
        'city',
        'name',
        'latitude',
        'longitude',
        'detail'
    ];

    public static function paramsCity()
    {
        $data = [
            "Jakarta Pusat",
            "Jakarta Utara",
            "Jakarta Selatan",
            "Jakarta Barat",
            "Jakarta Timur",
            "Kepulauan Seribu"
        ];

        return $data;
    }

    public static function paramsLevelRegion()
    {
        $data = [
            "KEL",
            "KEC",
            "KOTA",
            "DINAS"
        ];
        
        return $data;
    }
}
