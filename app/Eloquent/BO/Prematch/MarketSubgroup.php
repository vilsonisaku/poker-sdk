<?php

namespace ExHelp\Eloquent\BO\Prematch;

use ExHelp\Eloquent\BO\Eloquent;
use ExHelp\Constants\BOKeys;

class MarketSubgroup extends Eloquent
{
    const redis_key = BOKeys::market_subgroups;


    protected $s_key;
    protected $group_id;


    function __construct($s_key,$group_id)
    {
        $this->s_key = $s_key;
        $this->group_id = $group_id;
        $this->setRedisKey([$s_key,$group_id]);
    }
    
}