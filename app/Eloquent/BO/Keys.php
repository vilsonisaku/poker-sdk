<?php

namespace ExHelp\Eloquent\BO;


use ExHelp\RedisKeys as ExRedisKeys;
use ExHelp\Eloquent\BO\Skin;

class Keys extends ExRedisKeys
{

    static function getSkinId()
    {
        return Skin::getOrFetchId();
    }

}