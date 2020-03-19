<?php

namespace ExHelp;

use Illuminate\Support\Facades\Redis;

abstract class SkinSkeleton
{
    abstract static function get($domain=null);

    abstract static function getId();

    abstract static function fetch();

    abstract static function getRedisKey($path);
}

Class Skin extends SkinSkeleton
{
    protected static $attr=['id','prematch_ids','domain','live_ids','locale'];

    const redis_key="skins_config";

    const storage_file="skins.json";

    protected static $active;

    protected static $all=null;

    protected static $lang=0;
    
    /*
    *   get active skin
    */
    public static function get($domain=null){
        $key = $domain?$domain:self::$active;
        return isset( self::$all[ $key ] ) ? self::$all[ $key ] : null;
    }

    public static function getOrFetch($domain=null){

    }

    public static function getRedisKey($path){

    }

    public static function getLang(){

    }
    
    /*
    *   get active skin id
    */
    public static function getId(){
        return self::$all[ self::$active ]['id'];
    }

    /*
    *   get or fetch skin id
    */
    public static function getOrFetchId($domain=null){

        $skin = static::getOrFetch();
        
        return $skin ? $skin['id']:null;
    }

    public static function getOrFetchDomain($domain=null){
        if(!self::$all) {
            self::fetch($domain);
        }
        if($domain) self::$active = $domain;
        
        return self::$active;
    }

    public static function set($domain){
        self::$active = $domain;
       return new self;
    }

    public static function setFirst(){
        self::$active = array_key_first(self::$all);
       return new self;
    }

    public static function all(){
        return self::$all;
    }

    public static function setAll($skins){
        self::$all = $skins;
        return new self;
    }

    /*
    *   fetch skins from redis
    */
    public static function fetch(){

        $skins = json_decode( Redis::get( self::redis_key ), true );

        $attr = self::$attr;

        foreach($skins as $domain => $skin){
            $skin['domain'] = $domain;
            $skins[ $domain ] = array_filter($skin,function($val,$key) use ($attr) {
                    return in_array($key,$attr);
            },1);
        }

        self::$active = self::$active ? self::$active : array_key_first($skins);
        self::$all = $skins;

        return new self;
    }

    /*
    * backup all skins
    */
    public static function backup(){
        \Storage::put(self::storage_file, json_encode( self::fetch()->all() ) );
    }

    /*
    * load skin backup
    */
    public static function getBackup(){

        $file = self::storage_file; 

        if( !\Storage::exists( $file ) ) {
            echo "storage/app/$file   --------- not exist! \n";
            return;
        }

        echo "storage/app/$file\n";
        $skins = \Storage::get( $file );

        $skins = is_string($skins) ? $skins : json_encode($skins);
        
        \Redis::set( self::redis_key , $skins);
    }

}

