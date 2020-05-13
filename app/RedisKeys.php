<?php

namespace ExHelp;

use ExHelp\Constants\BOKeys;
use ExHelp\Constants\CachingKeys;

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

    static function get($key,$path='',$bySkin=true)
    {
        $boKeys = (new \ReflectionClass( BOKeys::class ) )->getConstants();
        $cachingKeys = (new \ReflectionClass( CachingKeys::class ) )->getConstants();

        $keys = [$boKeys,$cachingKeys];
        
        $skin_id = $bySkin? static::getSkinId().'_' : '';

        foreach($keys as $appKeys){

            if( !in_array($key,$appKeys) ) continue;

            return $appKeys['prefix'].$skin_id. $key. $path;
        }
        return null;
    }
}