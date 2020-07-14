<?php

namespace ExHelp\Eloquent\BO\Navbar;

use ExHelp\Eloquent\BO\Eloquent;
use ExHelp\Constants\BOKeys;
use ExHelp\Eloquent\BO\Navbar\Categories;

class Sports extends Eloquent
{
    const redis_key = BOKeys::navbar_sports;


    function tournaments($s_key){
        return new Categories($s_key);
    }
    
}