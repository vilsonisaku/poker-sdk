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
    public static function skin(){ // 6 = euro

        return new Casino(static::endpoint,static::getToken(),static::getSkinId(),static::getCurrencyId() );
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