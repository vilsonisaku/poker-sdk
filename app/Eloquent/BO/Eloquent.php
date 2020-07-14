<?php

namespace ExHelp\Eloquent\BO;


use ExHelp\Eloquent as ExEloquent;
use ExHelp\Filter;
use ExHelp\Eloquent\BO\Skin;

class Eloquent extends ExEloquent
{
    const bySkin=true;

    const str_split = ';';

    const skin_fillable = [];


    /*
    *   update fillable skin attributes from BO attributes
    */
    function updateSkinFillable(&$skin_data,$key,$id=null){

        if( !isset($skin_data->$key) ) return;

        if( !$this->getOrFetch() ) return $skin_data->$key;

        foreach(static::skin_fillable as $skin_key => $bo_key){

            if(is_array($bo_key)){

                $value = $this->skinMergeMinified($id?:$key,$bo_key);

            } else {
                $value = $this->getValue($id?:$key,$bo_key);
            }

            $skin_data->$key->$skin_key = $value;
        }
        return $skin_data->$key;
    }

    static function filterSkinFillable(&$skin_data,$bo_data){

        $fillable =  static::fillable;
        
        foreach(static::skin_fillable as $skin_key => $bo_key){

            if( !isset($bo_data[$bo_key]) ) continue;

            $value = $bo_data[$bo_key];


            $lang = false;

            if( isset($fillable[ $bo_key ]) ){
                $lang = $fillable[$bo_key]=='lang';
            } else {

            }

            if($lang) $value = static::getLangValue($value);

            $skin_data->$skin_key = $value;
        }
        return $skin_data;
    }


    function skinChildMinified($namespace,$key,$type){
        $child = new $namespace($this->key(),$key);

        $data = $child->getOrFetch()?:[];

        if($type == "array"){
            $list = [];
            foreach($data as $key => $item){

                $object = new \stdClass;
                $min_item =  $child->createSkinMinified($object,$key);

                if($min_item)
                    $list[] = $min_item;
            }
            return $list;
        }
        return $data;
    }

    function skinMergeMinified($keyOrItem,$bo_key){
        $value = [];
        foreach($bo_key as $b_key){
            $value[] = $this->getValue($keyOrItem,$b_key);
        }
        $value = implode(self::str_split,$value);

        return $value;
    }

    function createSkinMinified(&$skin_data,$key){

        $bo_list = $this->getOrFetch()?:[];

        if( !isset($bo_list[$key]) ) return;

        $bo_item = $bo_list[$key];

        if( !$this->isActive($key) ) return;


        $fillable =  static::fillable;

        foreach(static::skin_fillable as $skin_key => $bo_key){

            if(is_array($bo_key)){

                $first_key = array_keys($bo_key)[0];
                if( is_numeric($first_key) ){
                    $value = $this->skinMergeMinified($bo_item,$bo_key);
                } else {
                    $namespace = array_values($bo_key)[0];

                    $value = $this->skinChildMinified($namespace,$key,$first_key);
                }

            } else {

                if( !isset($bo_item[$bo_key]) ) continue;

                $value = $this->getValue($bo_item,$bo_key,false);
            }

            $skin_data->$skin_key = $value;
        }
        return $skin_data;
    }

    static function filterBOMFillable(&$bo_data,$bom_data){

        foreach(static::fillable as $bo_key => $bo_type){

            if( !isset($bom_data[$bo_key]) ) continue;

            $value = $bom_data[$bo_key];

            $bo_data[$bo_key] = $value;
        }
        return $bo_data;
    }

    function getItemKey($key){
        if($this->key){
            $keys = Filter::sep($this->key);

            if( !isset($keys[1]) ){
                return Filter::sep([$keys[0],$key]);
            }

            return Filter::sep([$keys[0],$keys[1],$key]);
        }
        return $key;
    }

    /*
    *   get values with nested arrays
    */
    function getValue($key,$bo_key,$itemKey=true){

        if( is_array($key) ) {
            $value = $key[ $bo_key ];
        } else {
            $key = $itemKey ? $this->getItemKey($key) : $itemKey;

            $value = $this->getOrFetch()[$key][$bo_key];
        }

        if( !isset(static::fillable[$bo_key]) ){
            return $value;
        }

        $lang = static::fillable[$bo_key]=='lang';
        if($lang) return static::getLangValue($value);

        return $value;
    }

    static function getLangValue($item){
        $lang = Skin::getLang();
        if( isset($item[$lang]) ){
            return $item[$lang];
        } else {
            return "";
        }
    }




    function restoreDefault(){
        $this->setDefault(true);
        $data = $this->getOrFetch();
        $this->setDefault(false);
        $this->set($data)->save();
    }

}