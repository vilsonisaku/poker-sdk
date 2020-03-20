<?php

namespace ExHelp;

use ExHelp\Constants\BOKeys;
use ExHelp\Constants\CachingKeys;
use ExHelp\Filter;

class RedisKeys
{
    static protected $skin_id;

    static protected $prefix='';

    static function getPrefix()
    {
        return self::$prefix;
    }

    static function setPrefix($prefix)
    {
        self::$prefix = $prefix;
    }

    static function getSkinId()
    {
        return self::$skin_id;
    }

    static function setSkinId($id)
    {
        self::$skin_id = $id;
    }

    static function get($key,$path=[])
    {
        $boKeys = (new \ReflectionClass( BOKeys::class ) )->getConstants();
        $cachingKeys = (new \ReflectionClass( CachingKeys::class ) )->getConstants();

        $keys = array_merge($boKeys,$cachingKeys);

        if( !in_array($key,$keys) ) return null;

        return self::$prefix.self::$skin_id.'_'.$key.Filter::sep($path);

    }
}