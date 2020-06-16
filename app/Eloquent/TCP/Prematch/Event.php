<?php

namespace ExHelp\Eloquent\TCP\Prematch;


use ExHelp\Constants\CachingKeys;
use ExHelp\Eloquent;
use ExHelp\Filter;

class Event extends Eloquent
{

    const bySkin=false;

    const redis_key = CachingKeys::prematch_event;

    function __construct($id="")
    {
        $this->key = $id;
    }

    function getSKey(){
        return Filter::sep([ $this->data['type'], $this->data['sport'] ]);
    }

    function getTKey(){
        return Filter::sep([ $this->data['type'], $this->data['sport'], $this->data['category'] ]);
    }
}