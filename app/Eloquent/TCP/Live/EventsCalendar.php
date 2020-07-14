<?php
namespace ExHelp\Eloquent\TCP\Live;


use ExHelp\Constants\CachingKeys;
use ExHelp\Eloquent;

class EventsCalendar extends Eloquent
{

    const bySkin=false;

    const redis_key = CachingKeys::live_calendar_events;


}