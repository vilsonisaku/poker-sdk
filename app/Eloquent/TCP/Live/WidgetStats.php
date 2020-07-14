<?php
namespace ExHelp\Eloquent\TCP\Live;


use ExHelp\Constants\CachingKeys;
use ExHelp\Eloquent;

class WidgetStats extends Eloquent
{

    const bySkin=false;

    const redis_key = CachingKeys::live_widget_stats;

}