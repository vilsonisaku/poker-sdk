<?php

namespace ExHelp;

use Illuminate\Support\Facades\Redis;
use ExHelp\RedisKeys;
use ExHelp\Lang;
use ExHelp\Filter;

class Eloquent
{
    const bySkin=true;

    const redis_key="";

    protected $key='';

    protected $data=false;

    protected $ex=false;

    const fillable=[];

    const types=[
        1=>'match', 
        2=>'outright', 
        3=>'player' 
    ];

    function __toString() {
        return $this->getRedisKey();
    }

    public function get(){
        return $this->data;
    }

    public function set($data){
        $this->data = $data;

        return $this;
    }

    public function getOrFetch(){
        if( $this->data === false ) $this->fetch();
        return $this->data;
    }

    public static function getLang(){
        return Lang::active();
    }

    public function setRedisKey($path=[]){
        $this->key = Filter::sep( array_filter($path) );
        return $this;
    }

    public function getRedisKey(){
        return RedisKeys::get(static::redis_key,$this->key,static::bySkin);
    }

    public function key($id=null){
        if(!$id) return $this->key;
        return Filter::sep( [$this->key, $id ]);
    }

    /*
    *   get base key by skin. ex: backoffice_10_navbar_tournament_
    */
    static function getBaseKey(){
        return Keys::get(static::redis_key,'',static::bySkin);
    }

    static function getLangValue($item){
        $lang = Skin::getLang();
        if( isset($item[$lang]) ){
            return $item[$lang];
        } else {
            return "";
        }
    }
    
    /*
    *   get all data from base key, by skin
    */
    static function getAll(){

        $keys_ids = static::getKeysIds();

        $all = [];

        foreach($keys_ids as $ids){
            $all[] = new static( ...$ids );
        }

        return $all;
    }

    /*
    *   get all redis keys from base key
    */
    static function getAllRedisKeys(){

        $base_key = static::getBaseKey();

        $keys = Redis::keys($base_key."*");

        $length = strlen( config('database.redis.options.prefix') );

        foreach($keys as $i => $key){
            $keys[$i] = substr($key,$length);
        }

        return $keys;
    }

    /*
    *   get all ids from base key
    */
    static function getKeysIds(){

        $keys = static::getAllRedisKeys();

        foreach($keys as $i => $key){
            
            $keys[$i] = static::getKeyIds($key);
        }

        return $keys;
    }

    /*
    *   get ids from an single redis key
    */
    static function getKeyIds($key){

        $base_key = static::getBaseKey();

        $length = strlen( $base_key );

        $ids = substr($key,$length);
        $ids = $ids ? Filter::sep( $ids ) : [];

        if( isset($ids[1]) ) {
            $ids[1] = Filter::sep( [ $ids[0],$ids[1] ] );
            array_shift($ids);
        }
        
        return $ids;
    }

    public static function generateId($type=""){
        $id = ( (int) (microtime(true) * 1000));
        return $type ? Filter::sep([$type,$id]) : $id;
    }

    public static function types($type=''){
        return isset( self::types[$type] )
            ? self::types[$type] : null;
    }

    /*
    *  get as collection
    */
    function collect($id=null)
    {
        if($id!==null){
            $data = $this->getItem($id)?:[];
        } else {
            $data = $this->getOrFetch()?:[];
        }
        return collect($data);
    }

    public static function filterArrayAttr($old_values,$val){
        $val = is_array($val) ? $val : [$val];
        foreach($val as $k => $v){
            if( !is_string($v) && !is_int($v) ) unset( $val[$k] );
        }
        return array_values( array_unique( array_merge($old_values,$val) ) );
    }

    public static function updateAttributes(&$data,$params,$k_id=null,$childFillable=null){
        $lang = self::getLang();
        foreach($params as $key => $new_values){
            if( !array_key_exists($key,$data) ) continue;

            $fillable = $childFillable?:static::fillable;

            foreach($fillable as $attr => $i){

                if($i==='boolean' && array_key_exists($attr,$new_values) ){
                    $v = $new_values[$attr];
                    if($v==1||$v==0||$v===false||$v===true){
                        $data[$key][$attr] = $new_values[$attr];
                    }
                    continue;
                }
                if( !array_key_exists($attr,$new_values) ) continue;

                if($i=='lang') {
                    $data[$key][$attr][ $lang ] = (string) $new_values[$attr];

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
                        self::updateAttributes($data[$key][$attr][ $id ], $new_values[$attr],null,$attr );
                    } else {
                        $index=null;
                        foreach($child as $c => $child_data){
                            if($child_data[ $k_id ] == $id){
                                $index = $c;
                            }
                        }
                        if($index!==null)
                            self::updateAttributes($data[$key][$attr], [ $index => $new_values[$attr] ] ,null ,$i );

                    }
                }
            }
        }
        return $data;
    }

    function fetch()
    {
        $this->data = json_decode( Redis::get( $this->getRedisKey() ), true );
        return $this;
    }

    function update(array $params=[] , $k_id=null )
    {
        $data = $this->getOrFetch();
        // self::updateAttributes($data, $params, $k_id );

        $this->data = $data;

        if($this->ex !== false){
            Redis::set( $this->getRedisKey() , json_encode($data),'EX',$this->ex );
        } else {
            Redis::set( $this->getRedisKey() , json_encode($data) );
        }

        return $this;
    }

    function save(){
        $this->set($this->data)->update();
        return $this;
    }



    /*
    *  get item on redis (BO)
    */
    function getItem($id)
    {
        $data = $this->getOrFetch()?:[];

        if( !isset( $data[ $id ] ) ) return null;

        return $data[ $id ];
    }

    /*
    *  set item on redis (BO)
    */
    function setItem($id,$item)
    {
        $data = $this->getOrFetch()?:[];

        $data[ $id ] = $item;

        $this->set($data);

        return $this;
    }

    function getExpire(){
        return $this->ex;
    }

    function setExpire($ex){
        $this->ex = $ex;
    }
    
    /*
    *   check if current item is active or not
    */
    function isActive($id,$key='active'){

        $list = $this->getOrFetch()?:[];

        if( !isset($list[$id]) ) return false;

        if( array_key_exists($key,$list[$id]) ){

            if(!$list[$id][$key]) return false;

        } else {
            return false;
        }
        return true;
    }


    /*
    *   flush current key
    */
    function flush(){
        $key = $this->getRedisKey();

        Redis::del( $key );

        return $key;
    }


    /*
    *   flush all data from base key
    */
    static function flushAll(){

        $keys = static::getAllRedisKeys();

        foreach($keys as $key){
            Redis::del( $key );
        }

        return $keys;
    }

    /*
    *  delete item on redis (BO)
    */
    function delete($id)
    {
        $data = $this->getOrFetch()?:[];

        if( !isset( $data[ $id ] ) ) return false;
        
        unset( $data[ $id ] );

        $this->set($data)->update();

        return true;
    }

}