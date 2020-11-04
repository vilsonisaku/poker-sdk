<?php

namespace Engine\Soap;


/**
  * Create Header class
*/
class Header
{

  public $idMessageTransaction;

  public $version;

  public $locale;

  public $idOperator;

  public $command;

  /**
   * Header constructor.
   *
   * @param array $header
   */
  public function __construct($header=[],$lang,$skin_id,$version)
  {
    $this->idMessageTransaction = (int) (microtime(true) * 1000000000);

    $this->idOperator = $skin_id;
    $this->locale = $lang;
    $this->version = $version;

    foreach ($header as $key => $value) {
      $this->$key = $value;
    }

  }

}


/**
  * Create input class
*/
class Input
{

  public $xmlns = ["xmlns:xsi"=>"http://www.w3.org/2001/XMLSchema-instance"];

  /**
   * Input constructor.
   *
   * @param array $data
   */
  public function __construct($data=[])
  {
    foreach ($data as $key => $value) {
      $this->$key = $value;
    }
  }

}


/**
  * Create Signature class
*/
class Signature {

    public $digestSecret="*wild*";

    public function __construct($data=[])
    {
      foreach ($data as $key => $value) {
        $this->$key = $value;
      }
    }
}


/**
  * Create Request class
*/
class RequestXml
{

  public $header;

  public $input;

  public $signature;

  protected $hidden=[];


  function fill($header=[],$body=[],$signature=[]){
    $values = $this->hidden;
    $this->header = new Header( $header, $values['lang'], $values['skin_id'], $values['version'] );
    $this->input = new Input($body);
    $this->signature = new Signature($signature);
    return $this->Convert();
  }

  function __construct($lang=[],$skin_id=[],$version='1.0.0'){
    $this->hidden = [
       'lang'=>$lang,
       'skin_id'=>$skin_id,
       'version'=>$version,
    ];
  }
  // function __construct($header=[],$body=[],$signature=[]){
  //   $this->header = new Header($header);
  //   $this->input = new Input($body);
  //   $this->signature = new Signature($signature);
  // }

  function Convert() {
      //Create DOMDocument
      $xml = new \DOMDocument('1.0', "UTF-8");
      //Add the Class Element
      $xmlElement = $xml->createElement('request');

      $xml->appendChild($xmlElement);
      //Start Add elements
      $this->ReadProperty($xmlElement, $this, $xml);

      $xml->preserveWhiteSpace=false;
      $xml->formatOutput=true;
      //Create the XML
      return $xml->saveXML();
  }

  private function ReadProperty($xmlElement, $object, $xml,$parent=null) {
      foreach ($object as $key => $value) {
          if($key==='hidden') continue;
          if ($value != null) {
              if (is_object($value)) {
                  $element = $xml->createElement($key);
                  
                  $this->ReadProperty($element, $value, $xml,$xmlElement);

              } else if (is_array($value)) {
                  foreach ($value as $k => $v) {
                      if(is_array($v)){
                          foreach ($v as $vk => $vv) {
                              $el = $xml->createElement($key);
                              $this->AddAttribute($el, $vk, $vv, $xml);
                              $parent->AppendChild($el);
                          }
                      } else {
                        $this->AddAttribute($xmlElement, $k, $v, $xml);
                        $parent->AppendChild($xmlElement);
                      }
                  }
              } else {
                  $this->AddElement($xmlElement, $key, $value, $xml);
                  $parent->AppendChild($xmlElement);
              }
          }
      }
  }

  private function AddElement($xmlElement, $key, $value, $xml) {
      $domAttribute = $xml->createElement($key,$value);
      $xmlElement->appendChild($domAttribute);
  }

  private function AddAttribute($xmlElement, $key, $value, $xml) {
      $domAttribute = $xml->createAttribute($key);
      $domAttribute->value = $value;
      $xmlElement->appendChild($domAttribute);
  }

}


