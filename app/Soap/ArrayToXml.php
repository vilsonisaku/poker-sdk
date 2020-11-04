<?php
namespace Engine\Soap;

use Spatie\ArrayToXml\ArrayToXml as ArrayToXmlDefault;

class ArrayToXml 
{
    protected $lang;
    protected $skin_id;
    protected $version="1.0.0";

	function __construct($lang,$skin_id)
    {
        $this->lang = $lang;
        $this->skin_id = $skin_id;
    }

    public function getSkinId(){
        return $this->skin_id;
    }

    public function convert(
    	array $header=[],
        array $array=[],
        $rootElement = 'request',
        bool $replaceSpacesByUnderScoresInKeyNames = true,
        string $xmlEncoding = 'UTF-8',
        string $xmlVersion = '1.0',
        array $domProperties = ['standalone'=>true]
    ) {

        $commandReq = isset($header['command']) ? $header['command'].'Request' : '';

        $arr_xml=[
            'header'=>[
                'idMessageTransaction'=>(int) (microtime(true) * 1000000000),
                'version'=>$this->version,
                'locale'=> $this->lang,
                'idOperator'=>$this->skin_id,
                'command'=>'',
            ],
            'input'=>[
                '_attributes'=>[
                    'xmlns:xsi'=>'http://www.w3.org/2001/XMLSchema-instance',
                    'xsi:type'=> $commandReq
                ],
            ],
        	'signature'=>[
                'digestSecret'=>'*wild*'
            ]
        ];


        foreach ($array as $ikey => $ivalue) {
        	if($ivalue!==null){
                if(is_array($ivalue)){
                    foreach ($ivalue as $k => $v) {
                       if($v!==null) $arr_xml['input'][$ikey][$k] = $v;
                    }
                } else {
                    if($ivalue!==null) $arr_xml['input'][$ikey] = $ivalue;
                }
            }
        }

        foreach ($header as $key => $value) {
        	$arr_xml['header'][$key]=$value;
        }

        $converter = new ArrayToXmlDefault(
            $arr_xml,
            $rootElement,
            $replaceSpacesByUnderScoresInKeyNames,
            $xmlEncoding,
            $xmlVersion,
            $domProperties
        );

        $converter->toDom()->formatOutput=true;

        return $converter->toXml();
    }

}