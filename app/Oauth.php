<?php
namespace Poker;

use GuzzleHttp\Client;

class Oauth {

    const oauth_token = 'oauth/token';

    protected $endpoint;
    protected $client_id;
    protected $client_secret;

    function __construct($endpoint,$client_id,$client_secret)
    {
        $this->endpoint = $endpoint;
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
    }

    /*
    *   Get oauth token from 3rd-party poker
    */
    function login($username,$password){

        $response = (new Client)->post( $this->endpoint.self::oauth_token , [
            'form_params' => [
                'username' => $username,
                'password' => $password,
                'client_id' => $this->client_id,
                'client_secret' => $this->client_secret,
                'grant_type' => 'password'
            ]
        ]);

        return json_decode($response->getBody()->getContents());
    }


    /*
    *   Refresh oauth token from 3rd-party poker
    */
    function refreshToken($refresh_token){

        $response = (new Client)->post( $this->endpoint.self::oauth_token  , [
            'form_params' => [
                'grant_type' => 'refresh_token',
                'refresh_token' => $refresh_token,
                'client_id' => $this->client_id,
                'client_secret' => $this->client_secret,
            ]
        ]);

        return json_decode($response->getBody()->getContents());
    }

}