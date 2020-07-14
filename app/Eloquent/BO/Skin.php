<?php

namespace ExHelp\Eloquent\BO;

use ExHelp\Skin as ExSkin;
use ExHelp\Filter;
use ExHelp\Eloquent\BO\Keys;

Class Skin extends ExSkin
{
    public static function sep($ids){
        return Filter::sep($ids);
    }

    public static function getOrFetch(){

        if( self::$all === false) { // keep it like this, otherwise will not work automaticaly on other modules

            self::fetch();
        
            $domain = request()->header('skin');

            $domain && self::set($domain);
        }

        return self::get();
    }

    public static function getRedisKey($path){
        return Keys::get($path);
    }

}
