<?php
namespace Poker;

use GuzzleHttp\Client;
use Poker\AuthHttp;

class Provider extends AuthHttp {


    function __construct($endpoint,$token)
    {
        $this->endpoint = $endpoint;
        $this->token = $token;
    }


    /*
    *   Get list of skins
    */
    public function getSkins(){

        $url = $this->endpoint.static::SKINS;

        $response = (new Client)->get( $url , [
            'headers'=> $this->getHeaders()
        ]);

        return json_decode( $response->getBody(), true );
    }


    /*
    *   Get skin id by domain
    */
    public function getSkinIdByDomain($domain){

        $url = $this->endpoint.static::CASINO_ID;

        $response = (new Client)->get( $url , [
            'query' => [
                'domain' => $domain,
            ],
            'headers'=> $this->getHeaders()
        ]);

        return json_decode( $response->getBody(), true );
    }


    /*
    *   Get list of currencies
    */
    public function getCurrencies(){

        $url = $this->endpoint.static::CURRENCIES;

        $response = (new Client)->get( $url , [
            'headers'=> $this->getHeaders()
        ]);

        return json_decode( $response->getBody(), true );
    }

}