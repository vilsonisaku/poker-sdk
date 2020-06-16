<?php

namespace ExHelp\Eloquent\LiveCasino;

use ExHelp\Eloquent;
use ExHelp\Constants\CachingKeys;

class GamesMobile extends Eloquent
{
    const bySkin=false;

    const redis_key = CachingKeys::microgame_mobile_livecasino_games;

}
