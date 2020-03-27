<?php

namespace ExHelp\Constants;

class CachingKeys
{
    const prefix = '';

    const prematch_navbar = self::prefix.'prematch_navbar';

    const prematch_all_filtered = self::prefix.'prematch_events_id_name';

    const prematch_event = self::prefix.'prematch_event_';

    const prematch_tournament = self::prefix.'prematch_events_tournament_';

    const prematch_lastminute = self::prefix.'prematch_lastminute';

    const prematch_overrided_odds = self::prefix.'event_market_odds';

    

    const market_config = self::prefix.'skin_config';

    const market_groups = self::prefix.'market_groups';



    const live_navbar = self::prefix.'live_navbar';

    const live_events = self::prefix.'live_events';

    const live_tmp_events = self::prefix.'live_tmp_events';


    const microgame_casino_games = self::prefix.'microgame_casino_games';

    const microgame_livecasino_games = self::prefix.'microgame_livecasino_games';

}
