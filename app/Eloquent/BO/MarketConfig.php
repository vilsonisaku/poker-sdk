<?php

namespace ExHelp\Eloquent\BO;

use ExHelp\Eloquent\BO\Eloquent;
use ExHelp\Constants\BOKeys;
use ExHelp\Filter;

class MarketConfig extends Eloquent
{
    const redis_key = BOKeys::markets_config;

    const market_scorer_ids = [10930,9901,14831]; // marcatore ids


    function __construct($s_key)
    {
        $s_key = is_array($s_key) ? Filter::sep($s_key) : $s_key ;

        $this->s_key = $s_key;
        
        $this->setRedisKey([$s_key]);
    }

    /*
    *   Get scorers
    */
    function getScorers(){
        $markets = $this->getOrFetch()?:[];
        $scorers=[];
        foreach($markets as $m_key => $market){
            $m_id = Filter::sep($m_key)[0];
            if( in_array($m_id,self::market_scorer_ids) ){
                $scorers[ $m_key ] = $market;
            }
        }
        return $scorers;
    }

    function removeScorers(){
        $scorers = $this->getScorers();
        foreach($scorers as $m_key => $scorer){
            $this->delete($m_key);
        }
    }

    function getById($id){
        $markets = $this->getOrFetch()?:[];
        $list =[];
        foreach($markets as $m_key => $market){

            $m_id = explode('.',$m_key)[0];

            ($m_id == $id) && $list[ $m_key ] = $market;
        }
        return $list;
    }

}