<?php
namespace Poker;

class AuthHttp {

    const SKINS = 'api/skins';
    const CURRENCIES = 'api/currencies';
    const CASINO_ID = 'api/skin/id';

    const PLAYERS = 'api/players';
    const PLAYER = 'api/player';

    protected $endpoint;
    protected $token;


    public function getHeaders(){
        return [
            'Authorization'=>'Bearer '.$this->token,
        ];
    }


}