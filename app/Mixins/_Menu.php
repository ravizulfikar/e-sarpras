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

                if(isset($value['type'])){
                    if($value['type'] = 'header' && self::RoleMenu($value['role'])){
                        $class .= '<li class="sidebar-main-title"><div><h6>'.$value['title'].'</h6><p>'.$value['description'].'</p></div></li>';
                    } else if($value['type'] = 'main-link' && self::RoleMenu($value['role'])){
                        $class .= '<li class="sidebar-list">';
                        if(isset($value['badge'])){
                            $class .= '<label class="badge badge-'.$value['badge']['type'].'">'.$value['badge']['data'].'</label>';
                        }
                        $class .= '<a class="sidebar-link sidebar-title link-nav '.self::ActiveMenu($value['route']).'" href="'.route($value['route']).'">';
                        $class .= '<i data-feather="'.$value['icon'].'"> </i><span>'.$value['title'].'</span>';
                        $class .= '</a>';
                        $class .= '</li>';
                    }
                }

                //Header Menu
                // if(isset($value['type']) && $value['type'] = 'header' && self::RoleMenu($value['role'])){
                //     $class .= '<li class="sidebar-main-title"><div><h6>'.$value['title'].'</h6><p>'.$value['description'].'</p></div></li>';
                // }

                

                //Menu Menu
                if(isset($value['menu'])){

                    foreach($value['menu'] as $keyMenu=>$valueMenu){

                        if(isset($valueMenu['type']) && isset($valueMenu['role'])){

                            if($valueMenu['type'] = 'main' && self::RoleMenu($valueMenu['role']) && isset($valueMenu['route'])){
                                $class .= '<li class="sidebar-list">';
                                if(isset($valueMenu['badge'])){
                                    $class .= '<label class="badge badge-'.$valueMenu['badge']['type'].'">'.$valueMenu['badge']['data'].'</label>';
                                }
                                $class .= '<a class="sidebar-link sidebar-title link-nav '.self::ActiveMenu($valueMenu['route']).'" href="'.route($valueMenu['route']).'">';
                                $class .= '<i data-feather="'.$valueMenu['icon'].'"> </i><span>'.$valueMenu['title'].'</span>';
                                $class .= '</a>';
                                $class .= '</li>';
                            }

                            if($valueMenu['type'] = 'submenu' && self::RoleMenu($valueMenu['role']) && isset($valueMenu['prefix'])){
                                $class .= '<li class="sidebar-list">';
                                if(isset($valueMenu['badge'])){
                                    $class .= '<label class="badge badge-'.$valueMenu['badge']['type'].'">'.$valueMenu['badge']['data'].'</label>';
                                }
                                $class .= '<a class="sidebar-link sidebar-title '.self::ActiveTreeMenu($valueMenu['prefix'], 'active').'" href="#">';
                                $class .= '<i data-feather="'.$valueMenu['icon'].'"></i><span>'.$valueMenu['title'].'</span>';
                                $class .= '<div class="according-menu"><i class="fa fa-angle-'.self::ActiveTreeMenu($valueMenu['prefix'], 'down').'"></i></div>';
                                $class .= '</a>';
                                $class .= '<ul class="sidebar-submenu" style="'.self::ActiveTreeMenu($valueMenu['prefix'], 'block').'">';
                                if(isset($valueMenu['submenu'])){
                                    foreach($valueMenu['submenu'] as $keySubMenu=>$valueSubMenu){
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

}
