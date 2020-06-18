<?php
namespace ExHelp\Transform\FeedToBo;

use ExHelp\Transform\Transform;
use ExHelp\Transform\FeedToBo\LangTransform;

class MarketTransform extends Transform {

    const keys = [
        'name'=> ['n'=>LangTransform::class],
        'short'=>null,
        'self_group'=>null,
        'vars'=>'vars',
        'specifier'=> 'specifier',
        'market_id'=>'m_key',
    ];

    const filter = [
        'short'=>[],
        'self_group'=>[],
    ];

}