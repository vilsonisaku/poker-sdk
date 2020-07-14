<?php

namespace ExHelp\Eloquent\BO\Navbar;

use ExHelp\Eloquent\BO\Eloquent;
use ExHelp\Constants\BOKeys;

class Tournaments extends Eloquent
{
    const redis_key = BOKeys::navbar_tournaments;

    protected $s_key;
    protected $c_key;


    function __construct($s_key,$c_key)
    {
        $this->s_key = $s_key;
        $this->c_key = $c_key;
        $this->setRedisKey([$s_key,$c_key]);
    }


}