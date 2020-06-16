<?php

namespace ExHelp\Eloquent\Casino;

use ExHelp\Eloquent;
use ExHelp\Constants\CachingKeys;

class GamesMobile extends Eloquent
{
    const bySkin=false;

    const redis_key = CachingKeys::microgame_mobile_casino_games;

}
