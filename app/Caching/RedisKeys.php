<?php

namespace ExHelp\Caching;

class RedisKeys
{

    const prematch    =    [
        'navbar'    =>    'prematch_navbar',
        'all_filtered'    =>    'prematch_events_id_name',
        'event'       =>    'prematch_event_',
        'tournament'    =>    'prematch_events_tournament_',
        'lastminute'    =>    'prematch_lastminute',
        'config'    =>    'skin_config',
        'groups'    =>  'market_groups',
    ];

    const live    =    [
        'event'    =>    'live_event_',
        'all_filtered'    =>    'skin_live_events_id_name',
        'navbar'    =>    'live_navbar',
        'events'    =>  'live_events',
        'tmp_events'    =>    'live_tmp_events',
        'config'    =>    'live_config',
    ];
    const event_market_odds = 'event_market_odds';
}
