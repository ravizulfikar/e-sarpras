<?php
namespace App\Mixins;

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

}
