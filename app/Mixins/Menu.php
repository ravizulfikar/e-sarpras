<?php
namespace App\Mixins;

use Illuminate\Support\Facades\Route;
use Auth;

class Menu
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
    
	public static function Render($item){
        $class = '';

        if(isset($item)){
            foreach($item as $key=>$value){

                //Menu Menu
                if(isset($value['type']) && isset($value['role'])){

                    if($value['type'] = 'header' && self::RoleMenu($value['role']) && isset($value['description'])){
                        $class .= '<li class="sidebar-main-title"><div><h6>'.$value['title'].'</h6><p>'.$value['description'].'</p></div></li>';
                    }

                    if($value['type'] = 'main' && self::RoleMenu($value['role']) && isset($value['route']) && isset($value['group']) && !isset($value['description'])){
                        $class .= '<li class="sidebar-list">';
                        if(isset($value['badge'])){
                            $class .= '<label class="badge badge-'.$value['badge']['type'].'">'.$value['badge']['data'].'</label>';
                        }
                        $class .= '<a class="sidebar-link sidebar-title link-nav '.self::ActiveMenuGroup($value['group']).'" href="'.route($value['route']).'">';
                        $class .= '<i data-feather="'.$value['icon'].'"> </i><span>'.$value['title'].'</span>';
                        $class .= '</a>';
                        $class .= '</li>';
                    }

                    if($value['type'] = 'submenu' && self::RoleMenu($value['role']) && isset($value['prefix'])){
                        $class .= '<li class="sidebar-list">';
                        if(isset($value['badge'])){
                            $class .= '<label class="badge badge-'.$value['badge']['type'].'">'.$value['badge']['data'].'</label>';
                        }
                        $class .= '<a class="sidebar-link sidebar-title '.self::ActiveTreeMenu($value['prefix'], 'active').'" href="#">';
                        $class .= '<i data-feather="'.$value['icon'].'"></i><span>'.$value['title'].'</span>';
                        $class .= '<div class="according-menu"><i class="fa fa-angle-'.self::ActiveTreeMenu($value['prefix'], 'down').'"></i></div>';
                        $class .= '</a>';
                        $class .= '<ul class="sidebar-submenu" style="'.self::ActiveTreeMenu($value['prefix'], 'block').'">';
                        if(isset($value['submenu'])){
                            foreach($value['submenu'] as $keySubMenu=>$valueSubMenu){
                                // dd(self::ActiveMenu($valueSubMenu['route']));
                                if(self::RoleMenu($valueSubMenu['role'])){
                                    $class .= '<li><a class="'.self::ActiveMenu($valueSubMenu['route']).'" href="'.route($valueSubMenu['route']).'">'.$valueSubMenu['title'].'</a></li>';
                                }
                            }
                        }
                        $class .= '</ul>';
                        $class .= '</li>';
                    }

                }

            }
        } else {
            $class = NULL;
        }

		return $class;
	}

    public static function ActiveMenu($name){
        return (Route::currentRouteName() == $name || request()->route()->getName() == $name) ? 'active' : '';
    }

    public static function ActiveMenuGroup($name){
        return (explode(".",Route::currentRouteName())[0] == $name) ? 'active' : '';
    }

    // (strpos(Route::currentRouteName(), 'admin.cities') == 0) ? 'active' : ''

    public static function ActiveTreeMenu($name, $class){
        if($class == 'active'){
            return (request()->route()->getPrefix() == $name || request()->route()->getPrefix() == '/'.$name) ? $class : '';
        } elseif ($class == 'down'){
            return (request()->route()->getPrefix() == $name || request()->route()->getPrefix() == '/'.$name) ? $class : 'right';
        } elseif ($class == 'block'){
            return (request()->route()->getPrefix() == $name || request()->route()->getPrefix() == '/'.$name) ? 'display: '.$class.';' : 'display: none;';
        }
    }

    public static function RoleMenu($role){
        return in_array(Auth::user()->role->slug, $role);
    }

    public static function CheckIsset($class){
        return isset($class) ? $class : '';
    }

}
