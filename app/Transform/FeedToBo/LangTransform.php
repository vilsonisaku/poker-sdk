<?php
namespace ExHelp\Transform\FeedToBo;

use ExHelp\Transform\Transform;

class LangTransform extends Transform {

    public static function keys($string){

        return ['IT'=>$string];
    }
}