<?php

namespace ExHelp\Eloquent\BO\Prematch;

use ExHelp\Eloquent\BO\Eloquent;
use ExHelp\Eloquent\BO\Prematch\MarketSubgroup;
use ExHelp\Constants\BOKeys;

class MarketGroup extends Eloquent
{
    const redis_key = BOKeys::market_groups;

    protected $s_key;

    function __construct($s_key)
    {
        $this->s_key = $s_key;
        $this->setRedisKey([$s_key]);
    }
    
    function subgroups($group_id){
        return new MarketSubgroup($this->s_key,$group_id);
    }
    
}