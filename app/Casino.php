<?php
namespace Poker;

use GuzzleHttp\Client;

class Casino {

    const PLAYERS = 'api/players';
    const PLAYER = 'api/player';

    protected $endpoint;
    protected $token;
    protected $currency_id;
    protected $id;

    function __construct($endpoint,$token,$id,$currency_id)
    {
        $this->endpoint = $endpoint;
        $this->token = $token;
        $this->id = $id;
        $this->currency_id = $currency_id;
    }

    public function getHeaders(){
        return [
            'Authorization'=>'Bearer '.$this->token,
        ];
    }


    /*
    *   Get list of players
    */
    public function getPlayers(){

        $url = $this->endpoint.static::PLAYERS;

        $response = (new Client)->get( $url , [
            'query' => [
                'skin_id' => $this->id,
            ],
            'headers'=> $this->getHeaders()
        ]);

        return $response->json();
    }


    /*
    *   Get player by id
    */
    public function getPlayer($idOrUsername,$key="id"){

        $url = $this->endpoint.static::PLAYER;

        $response = (new Client)->get( $url , [
            'query' => [
                'skin_id' => $this->id,
                $key => $idOrUsername,
            ],
            'headers'=> $this->getHeaders()
        ]);

        return $response->json();
    }


    /*
    *   Create Player
    */
    public function createPlayer($nickname,$username,$email,$password){

        $url = $this->endpoint.static::PLAYER;

        $response = (new Client)->post( $url , [
            'query' => [
                'skin_id' => $this->id,
                'currency_id' => $this->currency_id,
                'nickname' => $nickname,
                'username' => $username,
                'email' => $email,
                'password' => $password,
            ],
            'headers'=> $this->getHeaders()
        ]);

        return $response->json();
    }

}