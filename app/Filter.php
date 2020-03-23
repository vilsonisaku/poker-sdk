<?php

namespace ExHelp;

Class Filter
{
    const sep = ".";

    static function sep($ids){
        return implode(self::sep,$ids);
    }


}