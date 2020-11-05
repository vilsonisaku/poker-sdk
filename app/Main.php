<?php
namespace Poker;

class Main {

    const endpoint ="https://admin-poker.islacode.com/skin/";
    
    protected static $client_id;
    protected static $client_secret;


    public static function getClientId(){
        return self::$client_id;
    }

    public static function getClientSecret(){
        return self::$client_secret;
    }

    public static function oauth($client_id=null,$client_secret=null){

        $client_id = $client_id ? :self::getClientId();

        $client_secret = $client_secret ? :self::getClientSecret();

        return new Oauth(static::endpoint,$client_id,$client_secret);
    }


    /*
    *   Load skin class
    */
    public static function skin($skin_id=null){ // 6 = euro

        $skin_id = $skin_id?$skin_id:static::getSkinId();

        return new Casino(static::endpoint,static::getToken(),$skin_id,static::getCurrencyId() );
    }

    /*
    *   Load provider class
    */
    public static function provider(){

        return new Provider(static::endpoint,static::getToken());
    }

    public static function getToken(){
        return "";
    }

    public static function getSkinId(){
        return null;
    }

    public static function getCurrencyId(){
        return 6;
    }

}