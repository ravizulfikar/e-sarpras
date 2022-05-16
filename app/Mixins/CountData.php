<?php

namespace App\Mixins;
use App\Models\Ticket;

class CountData
{
    /**
     * Aside menu
     * @param $item
     * @param null $parent
     * @param int $rec
     * @param bool $singleItem
     *
     * @return string
     */
    
	public static function getCount(){
        return '2';
	}

    public static function getKlasifikasi(){
        return 'new';
	}

    public static function getCountDataByStatus($status){
        // return $status;
        return Ticket::whereStatus($status)->count();
    }

}
