<?php

namespace ExHelp;

use Illuminate\Support\Facades\Redis;
use ExHelp\Lang;
use ExHelp\RedisKeys;

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

    protected static $all=false;
    
    /*
    *   get active skin
    */
    public static function get($domain=null){

        $key = $domain ? $domain : self::$active;

        return isset( self::$all[ $key ] ) 
                ? self::$all[ $key ] : null;
    }

    public static function getOrFetch(){

    }

    public static function getRedisKey($path){

    }

    public static function getLang(){
        return Lang::active();
    }

    public static function setLang($lang){

        $langs = self::get()['locale'];

        if(empty($langs)) return null;

        if( !in_array($lang,$langs) ) return null;

        Lang::setAll($langs);

        Lang::setActive($lang);

        return new self;
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
    public static function getOrFetchId(){

        $skin = static::getOrFetch();
        
        return $skin ? $skin['id']:null;
    }

    public static function getOrFetchDomain(){
        self::getAll();
        
        return self::$active;
    }

    public static function set(String $domain){

        if(self::$all===false) self::fetch();

        if( !self::exist($domain) ) return null;

        self::$active = $domain;

        $langs = self::get()['locale'];

        Lang::setAll($langs);
        Lang::setDefault();

        RedisKeys::setSkinId( static::getId() );

        return new self;
    }

    public static function exist($domain){

        $all = self::getAll();

        return isset( $all[$domain] ) ? true : false;
    }

    public static function getAll(){
        return self::$all;
    }

    protected static function setAll(array $skins){
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

        $domains = array_keys($skins);

        if( !in_array( self::$active,$domains) ){
            self::$active=null;
        }
        self::setAll( $skins );

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

