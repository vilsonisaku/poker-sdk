<?php

require __DIR__ . '/vendor/autoload.php';


use ExHelp\Skin;
use Kernel\Redis\Skin as RedisSkin;

print_r( skin::print() );

print_r( RedisSkin::fetch()->get() );

?>
