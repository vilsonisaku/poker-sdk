<?php

namespace ExHelp\Eloquent\TCP\Live;


use ExHelp\Constants\CachingKeys;
use ExHelp\Eloquent;

class Events extends Eloquent
{

    protected $index = null;

    const bySkin=false;

    const redis_key = CachingKeys::live_events;

    function getIndex(){
        return $this->index;
    }
    
    /*
    *  get item on redis
    */
    function getItem($id)
    {
        $data = $this->getOrFetch()?:[];

        foreach($data as $i => $item){

            if( $item['id'] == $id ) {

                $this->index = $i;

                return $item;
            }
        }
        return null;
    }

}