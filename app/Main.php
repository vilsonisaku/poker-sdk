<?php
namespace Poker;

class Main {

    const endpoint ="https://admin-poker.islacode.com/skin/";


    public static function oauth($client_id,$client_secret){

        return new Oauth(static::endpoint,$client_id,$client_secret);
    }


    public static function skin($token,$id,$currency_id=6){ // 6 = euro

        return new Casino(static::endpoint,$token,$id,$currency_id);
    }

    public static function provider($token){

        return new Provider(static::endpoint,$token);
    }
}