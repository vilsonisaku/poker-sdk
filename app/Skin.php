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

    const default_skin_id = 10;

    const redis_key="skins_config";

    const storage_file="skins.json";

    protected static $active;

    protected static $all=false;
    

    public static function getDefault(){
        if( self::$all === false) {
            self::fetch();
        }
        return self::firstById(static::default_skin_id);
    }

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

    public static function getLangNames(){
        $langs = self::get()['locale'];
        return collect($langs)->sortByDesc('default')->pluck('name')->all();
    }

    public static function setLang($lang){

        $langs = self::getLangNames();

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

        $is = isset(self::$all[ self::$active ]);

        return $is ? self::$all[ self::$active ]['id'] : null;
    }

    /*
    *   get or fetch skin id from (headers or session)
    */
    public static function getOrFetchId(){

        $skin = static::getOrFetch();
        
        return $skin ? $skin['id']:null;
    }

    /*
    *   get or fetch domain from (headers or session)
    */
    public static function getOrFetchDomain(){

        static::getOrFetch();
        
        return self::$active;
    }

    /*
    *   fetch once and set the active domain
    */
    public static function set(String $domain){

        self::fetchIfNot();

        if( !self::exist($domain) ) return null;

        self::$active = $domain;

        $langs = self::getLangNames();

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
    *   set active skin id
    */
    public static function setId($id){
        if( self::$all === false) {
            self::fetch();
        }
        $skin = collect( self::$all )->where('id',$id)->first();

        if(!$skin) return;

        static::set($skin['domain']);

        return static::get();
    }

    /*
    *   get all skins (domains) by id
    */
    public static function getById($id){
        return collect( static::fetchIfNot()->getAll() )->where('id',$id)->all();
    }

    /*
    *   get first skin (domains) by id
    */
    public static function firstById($id){

        return collect( static::fetchIfNot()->getAll() )->where('id',$id)->first();
    }

    /*
    *   fetch skins from redis
    */
    public static function fetch(){

        $skins = json_decode( Redis::get( self::redis_key ), true );

        if(!$skins) return;

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

    public static function fetchIfNot(){

        if( self::$all === false) {

            self::fetch();
        }
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

