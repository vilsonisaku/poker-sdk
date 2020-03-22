<?php

namespace ExHelp;

use Illuminate\Support\Facades\Redis;
use ExHelp\RedisKeys;
use ExHelp\Lang;

class Eloquent
{
    protected $redis_key;

    protected $data=false;

    const fillable=[];

    const types=[
        1=>'match', 
        2=>'outright', 
        3=>'player' 
    ];

    public function get(){
        return $this->data;
    }

    public function set($data){
        $this->data = $data;
    }

    public function getOrFetch(){
        if( $this->data === false ) $this->fetch();
        return $this->data;
    }

    public static function getLang(){
        return Lang::active();
    }

    public function setRedisKey($path=[],$bySkin=true){
        $this->redis_key = RedisKeys::get($this->redis_key,$path,$bySkin);
    }

    public function getRedisKey(){
        return $this->redis_key;
    }

    public static function generateId($type=""){
        $id = ( (int) (microtime(true) * 1000));
        return $type ? ($type.'.'.$id) : $id;
    }

    public static function types($type=''){
        return isset( self::types[$type] )
            ? self::types[$type] : null;
    }

    public static function filterArrayAttr($old_values,$val){
        $val = is_array($val) ? $val : [$val];
        foreach($val as $k => $v){
            if( !is_string($v) && !is_int($v) ) unset( $val[$k] );
        }
        return array_values( array_unique( array_merge($old_values,$val) ) );
    }

    public static function updateAttributes(&$data,$params,$k_id=null){
        $lang = self::getLang();
        foreach($params as $key => $new_values){
            if( !isset($data[$key]) ) continue;

            foreach(self::fillable as $attr => $i){

                if($i==='boolean' && array_key_exists($attr,$new_values) ){
                    $v = $new_values[$attr];
                    if($v==1||$v==0||$v===false||$v===true){
                        $data[$key][$attr] = $new_values[$attr];
                    }
                    continue;
                }
                if( !isset($new_values[$attr]) ) continue;

                if($i=='lang') {
                    $data[$key][$attr][ $lang ] = $new_values[$attr];

                } else if($i=='integer'){

                    $data[$key][$attr] = (int) $new_values[$attr];

                } else if($i=='string'){
                    $data[$key][$attr] = $new_values[$attr];

                } else if($i=='array'){
                    $data[$key][$attr] = self::filterArrayAttr( $data[$key][$attr], $new_values[$attr] );

                } else if ( is_array($i) && $k_id ){
                    
                    $id = $new_values[$attr][ $k_id ];
                    $child = $data[$key][$attr];

                    if(is_object($child)){
                        self::updateAttributes($attr, $data[$key][$attr][ $id ], $new_values[$attr] );
                    } else {
                        $index=null;
                        foreach($child as $c => $child_data){
                            if($child_data[ $k_id ] == $id){
                                $index = $c;
                            }
                        }
                        if($index!==null)
                            self::updateAttributes($i, $data[$key][$attr], [ $index => $new_values[$attr] ] );

                    }
                }
            }
        }
        return $data;
    }

    function fetch()
    {
        $this->data = json_decode( Redis::get( self::getRedisKey() ), true );
        return $this;
    }

    function update( $params=[] )
    {
        self::updateAttributes($this->data, $params);

        Redis::set( self::getRedisKey() , $this->data );
        
        return new self;
    }

}