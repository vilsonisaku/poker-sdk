<?php
namespace Engine\Soap;

/*
 * Class to convert Class to XML
 */

/**
 * Description of ClassToXML
 *
 * @author tyrodeveloper
 */
class ClassToXML {

    private $xml = null;

    function Convert($object) {
        //Create DOMDocument
        $this->xml = new \DOMDocument('1.0', "UTF-8");

        $obj = preg_replace("/[^A-Za-z0-9]/", "", (new \ReflectionClass($object))->getShortName() );
        //Add the Class Element
        $xmlElement = $this->xml->createElement($obj);

        $this->xml->appendChild($xmlElement);
        //Start Add elements
        $this->ReadProperty($xmlElement, $object);
        //Create the XML
        return $this->xml->saveXML();
    }

    private function ReadProperty($xmlElement, $object) {
        foreach ($object as $key => $value) {
            if ($value != null) {
                if (is_object($value)) {
                    $element = $this->xml->createElement($key);
                    
                    $this->ReadProperty($element, $value);
                    $xmlElement->AppendChild($element);

                } elseif (is_array($value)) {
                    foreach ($value as $k => $v) {
                        $this->AddAttribute($xmlElement, $k, $v);
                    }
                     
                } else {
                    $this->AddElement($xmlElement, $key, $value);
                }
            }
        }
    }

    private function AddElement($xmlElement, $key, $value) {
        $domAttribute = $this->xml->createElement($key,$value);
        $xmlElement->appendChild($domAttribute);
    }

    private function AddAttribute($xmlElement, $key, $value) {
        $domAttribute = $this->xml->createAttribute($key);
        $domAttribute->value = $value;
        $xmlElement->appendChild($domAttribute);
    }

}