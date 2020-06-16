<?php

namespace ExHelp\Eloquent\LiveCasino;

use ExHelp\Eloquent;
use ExHelp\Constants\CachingKeys;

class GamesDesktop extends Eloquent
{
    const bySkin=false;

    const redis_key = CachingKeys::microgame_livecasino_games;

}
