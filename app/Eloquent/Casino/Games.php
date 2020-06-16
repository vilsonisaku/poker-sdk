<?php

namespace ExHelp\Eloquent\Casino;

use ExHelp\Eloquent;
use ExHelp\Constants\CachingKeys;

class Games extends Eloquent
{
    const bySkin=false;

    const redis_key = CachingKeys::microgame_casino_games;

}
