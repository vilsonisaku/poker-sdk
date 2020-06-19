<?php

namespace ExHelp;

use ExHelp\Constants\BOKeys;
use ExHelp\Constants\CachingKeys;
use ExHelp\Skin;

class RedisKeys
{
    static protected $skin_id;


    static function getSkinId()
    {
        return self::$skin_id;
    }

    static function setSkinId($id)
    {
        self::$skin_id = $id;
    }

    static function keys(){
        $boKeys = (new \ReflectionClass( BOKeys::class ) )->getConstants();
        $cachingKeys = (new \ReflectionClass( CachingKeys::class ) )->getConstants();

        return [$boKeys,$cachingKeys];
    }

    static function get($key,$path='',$bySkin=true)
    {
        $keys = static::keys();
        
        $skin_id = $bySkin? static::getSkinId().'_' : '';

        foreach($keys as $appKeys){

            if( !in_array($key,$appKeys) ) continue;

            return $appKeys['prefix'].$skin_id. $key. $path;
        }
        return null;
    }

    static function getDefault($key,$path='')
    {
        $keys = static::keys();
        
        $skin_id = Skin::default_skin_id.'_';

        foreach($keys as $appKeys){

            if( !in_array($key,$appKeys) ) continue;

            return $appKeys['prefix'].$skin_id. $key. $path;
        }
        return null;
    }
}