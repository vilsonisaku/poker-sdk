<?php
namespace Poker;

class Main {

    const endpoint ="https://admin-poker.islacode.com/skin/";


    public static function oauth($client_id,$client_secret){

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