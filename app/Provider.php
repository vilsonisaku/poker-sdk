<?php
namespace Poker;

use GuzzleHttp\Client;

class Provider {

    const SKINS = 'api/skins';
    const CURRENCIES = 'api/currencies';

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