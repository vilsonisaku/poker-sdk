<?php
namespace ExHelp\Engine\Soap\Sportsbook;

use ExHelp\Engine\Soap\MainHttp;

/**
 *
 * @author Http
 */
class Http extends MainHttp {


    /*
    *   Get all prematch events request
    */
    function getPrematchEvents($sport='0',$category='0'){

        $xmlRequest = $this->requestXml->fill([
            'command'=>'searchPreMatchEvents',
        ],[
            'xsi'=>['xsi:type'=>'searchPreMatchEventsRequest'],
            'idSport'=>$sport,
            'idCategory'=>$category,
        ]);


        $xmlstr = $this->post($xmlRequest);

        $events = $this->parseXml($xmlstr);

        if(!$events || !isset($events['output']) )
            die("There is no prematch events\n");

        if(!isset($events['output']['event']) )
            return $events['output'];

        return $events['output']['event'];
    }

    /*
    *   Get all live events request
    */
    function getLiveEvents(){
        $xmlRequest = $this->requestXml->fill([
            'command'=>'searchLiveEvents',
        ],[
            'xsi'=>['xsi:type'=>'searchLiveEventsRequest'],
            'running'=>'true',
        ]);

        $xmlstr = $this->post($xmlRequest);

        $events = $this->parseXml($xmlstr);

        if(!$events || !isset($events['output']) )
            die("Live is not started\n");

        if(!isset($events['output']['event']))
            die(json_encode($events));

        return $events['output']['event'];
    }

    /*
    *   Check ticket status request
    */
    function getTicketDetails($token,$idTicket){

        $xmlRequest = $this->requestXml->fill([
            'command'=>'getTicketDetailsAdv',
        ],[
            'xsi'=>['xsi:type'=>'getTicketDetailsAdvRequest'],
            'ssoToken'=>$token,
            'idTicket'=>$idTicket,
        ]);

        $xmlstr = $this->post($xmlRequest);

        $data = $this->parseXml($xmlstr,true,true);

        return $data;
    }


    /*
    *   accept ticket request
    */
    function acceptTicket($token,$idTicket,$accepted){

        $xmlRequest = $this->requestXml->fill([
            'command'=>'AcceptTicket',
        ],[
            'xsi'=>['xsi:type'=>'AcceptTicketRequest'],
            'ssoToken'=>$token,
            'idTicket'=>$idTicket,
            'accepted'=>$accepted
        ]);

        $xmlstr = $this->post($xmlRequest);

        $data = $this->parseXml($xmlstr,true,true);

        return $data;
    }



    function getMarketModelGroup($token,$idSport=1){
        $xmlRequest = $this->requestXml->fill([
            'idOperator'=>6,
            'command'=>'getMarketModelGroup',
        ],[
            'xsi'=>['xsi:type'=>'getMarketModelGroupRequest'],
            'ssoToken'=>$token,
        ]);

        

        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr);
    }

    /**
     *  place bet for guest
     */
    function placeBetMultiplaSistemaGuest($eventsReq ,$pricesReq,$oddsChange){

        foreach ($eventsReq as $event) {
            if($event[0]){
                if( (new $this->liveEventModel)->fetch()->find($event[0]) ){
                    return ['resultCode'=>422];
                }
            }
        }

        $xmlRequest = $this->placeBetXML->guest($oddsChange,$eventsReq,$pricesReq);

        $xmlstr = $this->post($xmlRequest);

        $data = $this->parseXml($xmlstr,true,true);

        return $data;
    }


    /**
     *  place bet for player
     */
    function placeBetMultiplaSistema($token,$eventsReq ,$pricesReq,$oddsChange){

        $xmlRequest = $this->placeBetXML->player($token,$oddsChange,$eventsReq,$pricesReq);

        $xmlstr = $this->post($xmlRequest);

        $data = $this->parseXml($xmlstr,true,true);

        return $data;
    }

    /**
     *  place bet for agency
     */
    function placeBetMultiplaSistemaAgency($player_id,$eventsReq ,$pricesReq,$oddsChange){

        $xmlRequest = $this->placeBetXML->agency($player_id,$oddsChange,$eventsReq,$pricesReq);

        $xmlstr = $this->post($xmlRequest);

        $data = $this->parseXml($xmlstr,true,true);

        return $data;
    }


    /**
     *  get place bet bonus
     */
    function getPlaceBetBonus($eventsReq ,$pricesReq,$oddsChange){

        $xmlRequest = $this->placeBetXML->bonus($oddsChange,$eventsReq,$pricesReq);

        $xmlstr = $this->post($xmlRequest);

        $data = $this->parseXml($xmlstr,true,true);

        return $data;
    }

 
    public function getSingleEvent($id){

        $xmlRequest = $this->arrayToXml->convert(['command' => 'getSingleEvent'], [
            '_attributes' => [
                'xsi:type'  => 'getSingleEventRequest',
            ],
            'idEvent'=>$id,
        ]);
        
        $xmlstr = $this->post( $xmlRequest );

        $data = $this->parseXml($xmlstr,true,true);

        return $data;
    }
}




