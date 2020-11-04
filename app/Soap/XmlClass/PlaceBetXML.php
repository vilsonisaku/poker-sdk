<?php
namespace Engine\Soap\XmlClass;

use Engine\Soap\ArrayToXml;
/**
 * Description of PlaceBetXML
 *
 * @author vilson
 */
class PlaceBetXML {

    protected $log = null;

    protected $arrayToXml;

    const PARAMS=[
        0=>'idEvent',
        1=>'idMarketPos',
        2=>'idMarketType',
        3=>'idResult',
        4=>'descriptionEvent',
        5=>'descriptionMarket',
        6=>'descriptionResult',
        7=>'min',
        8=>'max',
        9=>'odd',
        10=>'var1',
        11=>'fixed'
    ];

    function __construct(ArrayToXml $arrayToXml,$log){
        $this->arrayToXml = $arrayToXml;
        $this->log = $log;
    }

    function getEvents($events){
        $elements = [];
        foreach ($events as $event) {
            $attr = [ "_attributes" =>[] ];

            foreach ($event as $i => $value) {
                $value === 0 && $value = "0";
                $value === false && $value = 'false';

                $attr['_attributes'][ self::PARAMS[$i] ] = $value;
            }
            $elements[] = $attr;
        }

        $this->log->debug($elements);

        return $elements;
    }

    function getPrices($events,$prices){

        if( !is_array($prices) ) $prices = get_object_vars($prices);

        $attr = [];
        foreach ($prices as $i => $price) {
            // $val = (count($prices)==1) ? count($prices) : $i; // send the number of combinations
            $singleAttr = [ "_attributes" =>[] ];

            $singleAttr['_attributes'][ 'value' ] = $i;
            $singleAttr['_attributes'][ 'amount' ] = $price;

            $attr[]=$singleAttr;
        }
        return $attr;
    }

    /*
    *   generate xml for the player
    */
    function guest($oddsChange,$events,$prices){

        $oddsChange = ($oddsChange == false || $oddsChange == 0) ? "false" : "true";

        $inputArray = [
            // 'allowChangeOdds'=> $oddsChange,
            'elements'=> $this->getEvents($events),
            'prices'=> $this->getPrices($events,$prices),
            'booking'=>'true'
        ];

        return $this->arrayToXml->convert(['command'=>'placeBetAdv'],$inputArray);
    }

    /*
    *   generate xml for the player
    */
    function player($token,$oddsChange,$events,$prices){

        $oddsChange = ($oddsChange == false || $oddsChange == 0) ? "false" : "true";

        $inputArray = [
            'ssoToken'=>$token,
            'allowChangeOdds'=> $oddsChange,
            'elements'=> $this->getEvents($events),
            'prices'=> $this->getPrices($events,$prices)
        ];

        return $this->arrayToXml->convert(['command'=>'placeBetAdv'],$inputArray);
    }

    /*
    *   generate xml for the agency to bet for player
    */
    function agency($player_id,$oddsChange,$events,$prices){

        $oddsChange = ($oddsChange == false || $oddsChange == 0) ? "false" : "true";

        $inputArray = [
            'accountCode'=> $this->arrayToXml->getSkinId().$player_id,
            'allowChangeOdds'=> $oddsChange,
            'elements'=> $this->getEvents($events),
            'prices'=> $this->getPrices($events,$prices)
        ];

        return $this->arrayToXml->convert(['command'=>'placeBetAdv'],$inputArray);
    }

    /*
    *   generate xml for the agency to bet for player
    */
    function bonus($oddsChange,$events,$prices){

        $oddsChange = ($oddsChange == false || $oddsChange == 0) ? "false" : "true";

        $inputArray = [
            '_attributes'=>[
                'xmlns:xsi'=>'http://www.w3.org/2001/XMLSchema-instance',
                'xsi:type'=> 'getBonusAmountAdvRequest'
            ],
            'allowChangeOdds'=> $oddsChange,
            'elements'=> $this->getEvents($events),
            'prices'=> $this->getPrices($events,$prices)
        ];

        return $this->arrayToXml->convert(['command'=>'getBonusAdv'],$inputArray);
    }
}


