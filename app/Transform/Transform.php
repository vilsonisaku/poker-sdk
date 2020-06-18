<?php

namespace ExHelp\Transform;


class Transform 
{
    const keys=[];
    const filter=[];

    public static function keys($item){

        foreach(static::keys as $ov_key => $current_key){

            if( is_array($current_key) ) {

                foreach($current_key as $key_name => $model){

                    $param = isset( $item[ $key_name ] ) ? $item[ $key_name ] : null;

                    $item[ $key_name ] = $model::item( $param );

                    $item = static::update($item,$ov_key,$key_name);

                }

            }

            $item = static::update($item,$ov_key,$current_key);
        }

        return $item;
    }

    public static function update($item,$ov_key,$current_key){

        if( !isset($item[ $current_key ]) || !$current_key ){

            $item[ $ov_key ] = static::filter($ov_key);
            return $item;
        }

        $item[ $ov_key ] = static::filter( $ov_key, $item[ $current_key ] );

        if( !isset( static::keys[ $current_key ]) ) { // if the key 
            unset( $item[ $current_key ] );
        }
        return $item;
    }

    public static function filter($key,$val=null){

        if( !isset(static::filter[$key]) ) return $val;

        return static::filter[$key];
    }

    static function item($item){
        return static::keys($item);
    }

}
