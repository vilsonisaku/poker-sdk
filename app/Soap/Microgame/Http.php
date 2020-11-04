<?php

namespace ExHelp\Engine\Soap\Microgame;

use GuzzleHttp\Client;
use Engine\Soap\MainHttp;

/**
 *
 * @author Http
 */
class Http extends MainHttp
{
    const prod_client_id = 'DB27C9DE-56C8-43F2-880F-DBBB76401E0B';
    const prod_client_secret = '';

    const client_id = '054A9989-A1F9-44DE-90EB-89CA8D41F09D';
    const client_secret = ''; // ddfdPBquTJ8fjdecaLeqhErlflSxbjtz


    const mg_endpoint = 'https://staging-sts.microgame.it/';

    const microgame_endpoint = self::mg_endpoint.'issue.aspx';

    const mg_endpoint_auth = self::mg_endpoint.'OAuth.svc';



    const skin_domain='goldsport24.it/'; // peoples.it
    
    const skin_endpoint='http://staging-resources.'.self::skin_domain;

    const people_prod_domain='peoples.it/';

    const casino_endpoint = self::skin_endpoint;
    // const casino_endpoint='http://staging-casino.peoples.it/';

    const poker_online_endpoint = self::skin_endpoint;
    // const poker_online_endpoint = "https://poker.".self::skin_domain;

    const poker_endpoint = self::skin_endpoint;
    // const poker_endpoint = "http://staging-poker.".self::skin_domain;

    const casino_game_url= self::casino_endpoint.'StartCasinoGame.ashx?game=';

    const casino_games_list= self::casino_endpoint.'casino.svc/v1/GetAllGames/AllCasino';

    const live_casino_games_list= self::casino_endpoint.'casino.svc/v1/GetAllGames/CasinoLive';
//http://staging-casino.peoples.it/casino.svc/v1/GetAllGames/AllCasino

    const poker_web = self::poker_endpoint."clientPage.ashx";


    const skin_endpoints = [
        'goldsport24.altechlab.com'=>'https://staging-resources.goldsport24.it',
        'staging.altechlab.com'=>'https://staging-resources.goldsport24.it',

        'betatomic.altechlab.com'=>'https://staging-resources.betatomic.it',
        'cherrybet.altechlab.com'=>'https://staging-resources.cherrybet.it',
    ];

    static function getCasinoGameUrl($id){
        // $host = request()->header('host');
        return "https://staging-resources.goldsport24.it/StartCasinoGame.ashx?game=$id";
    }

    static function getSkinEndpoint(){
        $host = request()->header('host');
        return self::skin_endpoints[ $host ];
    }

    /**
     * http post request
     */
    public function get($api,$options=[])
    {
        $client = new Client([
            'verify'          => false,
            'allow_redirects' => true,
        ]);

        $res = $client->request('GET', $api, $options);

        $data = $res->getBody()->getContents();

        \Log::debug( $res->getStatusCode() );

        return $data;
    }

    /**
     * http post request
     */
    public function post($api,$options=[])
    {
        $client = new Client([
            'verify'          => false,
            'allow_redirects' => true,
        ]);

        $res = $client->request('POST', $api, $options);

        $xmlstr = $res->getBody()->getContents();

        \Log::debug( $res->getStatusCode() );

        return $xmlstr;
    }

    public function auth($scope){
        $param =[
            "grant_type"=>"client_credentials",
            "client_id"=> self::client_id,
		    "client_secret"=>self::client_secret,
            "scope"=> self::skin_endpoint.$scope
        ];
        return  $this->post(self::mg_endpoint_auth,[
            'headers' => [
                "Content-Type" => "application/x-www-form-urlencoded",
            ],
            'form_params'=>$param 
        ]);
    }

    public function getPokerDownloadableUrl($type='dl',$platform='win',$https='true'){
        $token = $this->auth("PokerLobbySecure.svc");

        $data = json_decode( $this->get(self::skin_endpoint."PokerLobbySecure.svc/v1/pokerurl/$type/$platform/$https",[
            'headers' => [
                "Content-Type" => "application/json",
                'authorization'=>  "OAuth ".$token
            ],
        ]) );

        return $data->ClientUrl;
    }



    function getCasinoGameslist(){

        $data = $this->get(self::casino_games_list);

        return json_decode( $data );
    }

    function getCasinoLiveGames(){

        $data = $this->get(self::live_casino_games_list);

        return json_decode( $data );
    }


    function getCasinoGameFun($game_id){

        return self::casino_game_url.$game_id;
    } 


    function getCasinoGameReal($game_id){

        return [
            'url' => self::microgame_endpoint.'?'.http_build_query([
                'wa'=>'wsignin1.0',
                'wtrealm'=> self::skin_endpoint,
                'whr'=> self::skin_endpoint,
                'wreply'=> (self::casino_game_url.$game_id),
            ]),
            'token'=> $this->token,
            'username'=> $this->data['username'],
            'sessionDuration'=> 30,
            // 'serviceCode'=>'PSV'
        ];
    }

    function playPokerWeb(){

        return [
            'url' => self::microgame_endpoint.'?'.http_build_query([
                'wa'=>'wsignin1.0',
                'wtrealm'=> self::skin_endpoint,
                'whr'=> self::skin_endpoint,
                'wreply'=> self::poker_web,
            ]),
            'token'=> $this->token,
            'username'=> $this->data['username'],
            'sessionDuration'=> 30,
            // 'serviceCode'=>'PSV'
        ];
    }

    function getTorneiEvents(){

        return json_decode( $this->post(self::poker_online_endpoint."pokerservice.svc/GetEvents",[
            'headers' => [
                "Content-Type" => "application/json",
                // "Host" => "staging-poker.peoples.it",
            ],
            'json'=>[
                'eventType'=>"GROUP_TOURNAMENT"
            ]
        ]) );
    }

    function getSitAndGoEvents(){

        return json_decode( $this->post(self::poker_online_endpoint."pokerservice.svc/GetEvents",[
            'headers' => [
                "Content-Type" => "application/json",
                // "Host" => "staging-poker.peoples.it",
            ],
            'json'=>[
                'eventType'=>"GROUP_SITNGO"
            ]
        ]) );
    }

    static function logoutCasinoUrl(){
        return self::casino_endpoint."Logout.ashx?action=forceLogout";
    }


    function stsPost($wreply){

        return [
            'url' => self::microgame_endpoint.'?'.http_build_query([
                'wa'=>'wsignin1.0',
                'wtrealm'=> self::skin_endpoint,
                'whr'=> self::skin_endpoint,
                'wreply'=> $wreply,
            ]),
            'token'=> $this->token,
            'username'=> $this->data['username'],
            'sessionDuration'=> 30,
            // 'serviceCode'=>'PSV'
        ];
    }

    /*
    *   play (open) skillgame card
    */
    function getCardGamesService($game_card=""){
        $token = $this->auth("CardGamesServiceSecure.svc");

        $data = json_decode( $this->post(self::skin_endpoint."/CardGamesServiceSecure.svc/GetCardGamesClientUrl/$game_card",[
            'headers' => [
                "Content-Type" => "application/json",
                'authorization'=>  "OAuth ".$token
            ],
        ]) );

        return $data;
    }

    function getSkillGameCards(){
        return [
            'CG_BRISCOLAPREMIOMATTO',
            'CG_TRESSETTE',
            'CG_CIRULLA',
            'CG_BURRACO',
            'CG_SCOPONE',
            'CG_BRISCOLA',
            'CG_SCALA40PREMIOMATTO',
            'CG_BURRACOPREMIOMATTO' ,
            'CG_SCOPAPREMIOMATTO' ,
            'CG_HEARTS',
            'CG_SCALA40', 
            'CG_ASSOPIGLIATUTTO', 
            'CG_POKERITALIANO' ,
            'CG_SCOPA',
            'CG_BESTIA'
        ];
    }

    function getLiveCasinoPendingGames(){
        $data = $this->get(self::casino_endpoint.'casino.svc/v1/getpendinggames');
        return json_decode($data);
    }

}