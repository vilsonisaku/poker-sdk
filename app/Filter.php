<?php

namespace ExHelp;

Class Filter
{
    const sep = ".";

    static function sep($ids){

        if( is_string($ids) ){
            return explode(self::sep,$ids);
        }
        
        return implode(self::sep,$ids);
    }


}