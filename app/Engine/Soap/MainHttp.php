<?php

namespace ExHelp\Engine\Soap;

use GuzzleHttp\Client;
use ExHelp\Engine\Constants;
use ExHelp\Engine\Soap\ArrayToXml;
use ExHelp\Engine\Soap\RequestXml;
use ExHelp\Engine\Soap\XmlClass\PlaceBetXML;

/**
 *
 * @author Http
 */
class MainHttp
{
    protected $endpoint;
    protected $liveEventModel;
    protected $arrayToXml;
    protected $requestXml;
    protected $placeBetXML;
    
    protected $error;
    protected $log;

    protected $code = 200;


    function __construct($endpoint,ArrayToXml $arrayToXml,RequestXml $requestXml,$log_channel,$liveEventModel=null)
    {
        $this->endpoint = $endpoint;   
        $this->log_channel = $log_channel;   
        $this->liveEventModel = $liveEventModel;   
        $this->arrayToXml = $arrayToXml;   
        $this->requestXml = $requestXml;   
        $this->log = \Log::channel($log_channel);   
        $this->placeBetXML = new PlaceBetXML($arrayToXml, $this->log );   
    }


    public static function sessionFlush(){
        $all = \Session::all();
        foreach($all as $key => $value){
            \Session::forget($key);
        }
        usleep( 200 * 1000 );
    }


    public function code()
    {
        return $this->code;
    }


    public function getError()
    {
        return ['message' => $this->error];
    }


    public function setError($msg)
    {
        $this->error = $msg;
        return false;
    }



    public function parse($xmlElement){
        if(!$xmlElement) return false;
        $data=[];
        foreach($xmlElement as $key => $el ){

            if($el instanceof \SimpleXMLElement ){

                $returnedData = $this->parse($el);

                $value = $returnedData?:json_decode( json_encode( $el ), true );

                if( isset($data[$key]) ){
                    $data[$key][] = $value;
                } else {    
                    $data[$key] = $value;
                }
            }
        }
        return $data;
    }



    /**
     *  Parse xml string
     */
    public function parseXml($xmlstr, $json = true, $all = false)
    {
        $simpleXml = simplexml_load_string($xmlstr);

        if ($simpleXml->resultCode != "0") {
            $this->code = 422;
        }

        if ($simpleXml->resultCode == 600) {
            static::sessionFlush();
        }

        if ($simpleXml->resultCode != "0" || $all) {
            $simpleXml->message = Constants::accountApi[$simpleXml->resultCode];
            return json_decode(json_encode($simpleXml), true);
        }

        if (!$simpleXml->output) {
            return $this->setError("Output not recrived");
        }

        return $json ? json_decode(json_encode($simpleXml->output), true) : $simpleXml->output;
    }



    /**
     * http post request
     */
    public function post($xmlRequest)
    {
        $this->log->info($xmlRequest);

        $client = new Client(['verify'=> false,'allow_redirects' => true]);

        $res = $client->request( 'POST', $this->endpoint, [
            'body'    => $xmlRequest,
            'headers' => [
                "Content-Type" => "application/xml",
            ],
        ]);

        $xmlstr = $res->getBody()->getContents();

        $this->log->info($xmlstr);

        return $xmlstr;
    }

}