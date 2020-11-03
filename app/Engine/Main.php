<?php
namespace ExHelp\Engine;

use ExHelp\Engine\Soap\Account\Http as AccountHttp;
use ExHelp\Engine\Soap\Sportsbook\Http as SportsbookHttp;
use App\Model\Redis\LiveEvent;
use ExHelp\Engine\Soap\ArrayToXml;
use ExHelp\Engine\Soap\RequestXml;
use ExHelp\Engine\Soap\XmlClass\PlaceBetXML;
use ExHelp\Skin;

class Main {

    const log_channel="account";

    public static function getSkin(){
        return Skin::class;
    }

    public static function accountHttp(){
        return new AccountHttp( 
            config('app.engine_api.account'), 
            static::arrayToXml(),
            static::requestXml(),
            self::log_channel, 
        );
    }

    public static function sportsbookHttp(){
        return new SportsbookHttp( 
            config('app.engine_api.sportsbook'), 
            static::arrayToXml(), 
            static::requestXml(), 
            self::log_channel,
            LiveEvent::class 
        );
    }

    public static function arrayToXml(){
        return new ArrayToXml( Skin::getLang(), Skin::getId() );
    }
    public static function requestXml(){
        return new RequestXml( Skin::getLang(), Skin::getId() );
    }
}