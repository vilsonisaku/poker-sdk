<?php
namespace Poker;

use GuzzleHttp\Client;

class Provider {

    const SKINS = 'api/skins';
    const CURRENCIES = 'api/currencies';
    const CASINO_ID = 'api/skin/id';

    protected $endpoint;
    protected $token;

    function __construct($endpoint,$token)
    {
        $this->endpoint = $endpoint;
        $this->token = $token;
    }

    public function getHeaders(){
        return [
            'Authorization'=>'Bearer '.$this->token,
        ];
    }



    /*
    *   Get list of skins
    */
    public function getSkins(){

        $url = $this->endpoint.static::SKINS;

        $response = (new Client)->get( $url , [
            'headers'=> $this->getHeaders()
        ]);

        return $response->json();
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

        return $response->json();
    }


    /*
    *   Get list of currencies
    */
    public function getCurrencies(){

        $url = $this->endpoint.static::CURRENCIES;

        $response = (new Client)->get( $url , [
            'headers'=> $this->getHeaders()
        ]);

        return $response->json();
    }

}