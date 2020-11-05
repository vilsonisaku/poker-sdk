<?php
namespace Poker;

use GuzzleHttp\Client;

class Provider {

    const SKINS = 'api/skins';
    const CURRENCIES = 'api/currencies';
    const CASINO = 'api/skin';

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

        return json_decode($response->getBody()->getContents());
    }


    /*
    *   Get skin id by domain
    */
    public function getSkinIdByDomain($domain){

        $url = $this->endpoint.static::CASINO;

        $response = (new Client)->get( $url , [
            'query' => [
                'domain' => $domain,
            ],
            'headers'=> $this->getHeaders()
        ]);

        return json_decode($response->getBody()->getContents());
    }

}