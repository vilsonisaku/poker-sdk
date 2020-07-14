<?php

namespace ExHelp\Eloquent\BO\Navbar;

use ExHelp\Eloquent\BO\Eloquent;
use ExHelp\Constants\BOKeys;

class Categories extends Eloquent
{
    const redis_key = BOKeys::navbar_categories;

    protected $s_key;


    function __construct($s_key)
    {
        $this->s_key = $s_key;
        $this->setRedisKey([$s_key]);
    }

    function tournaments($c_id){
        return new Tournaments($this->s_key, $c_id);
    }

}