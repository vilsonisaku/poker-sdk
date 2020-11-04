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

        return json_decode($response->getBody()->getContents());
    }


    /*
    *   Get player by id
    */
    public function getPlayer($player_id){

        $url = $this->endpoint.static::PLAYER;

        $response = (new Client)->get( $url , [
            'query' => [
                'skin_id' => $this->id,
                'id' => $player_id,
            ],
            'headers'=> $this->getHeaders()
        ]);

        return json_decode($response->getBody()->getContents());
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

        return json_decode($response->getBody()->getContents());
    }

}