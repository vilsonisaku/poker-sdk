<?php

namespace ExHelp;

Class Lang
{

    static protected $active;

    static protected $all=[];

    static function active(){
        return self::$active;
    }

    static function setActive($lang){
        if( !in_array($lang,self::$all) ) 
            return false;

        self::$active = $lang;

        return true;
    }

    static function setDefault(){

        if( empty( self::$all ) )
            return false;

        self::setActive( self::$all[0] );

        return true;
    }

    static function getAll(){
        return self::$all;
    }
    
    static function setAll(array $all){
        self::$all = $all;
        return new self;
    }
}