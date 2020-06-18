<?php
namespace ExHelp\Transform\FeedToBo;

use ExHelp\Transform\Transform;
use ExHelp\Transform\FeedToBo\LangTransform;

class ResultTransform extends Transform {

    const keys = [
        'name'=> ['n'=>LangTransform::class],
        'description'=>null,
        'labelid'=>'id',
    ];

    const filter = [
        'description'=>[],
    ];

}