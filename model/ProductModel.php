<?php


class ProductModel extends Model {

    protected static $table = 'products';

    protected static function setProperties(){
        self::$properties['limit'] = [
            'type' => 'int',
        ];
    }

    public static function getAll(){
        return db::getInstance()->Select(
            'SELECT * FROM '.self::$table.'');
    }

    public static function getOne($id){
        return db::getInstance()->One(
            'SELECT * FROM '.self::$table.' WHERE id = :id',['id' => $id]);
    }


    public static function getLimitItem($limit){
        $limit = (int)$limit;
        return db::getInstance()->Select(
            'SELECT * FROM '.self::$table.' LIMIT :limit',['limit' => $limit]);
    }

    public function getPaginationProduct($count,$lastId){
        $sql = 'SELECT * FROM '.self::$table.' where id > :lastId LIMIT :count';
        $result = db::getInstance()->Select($sql,['lastId' => $lastId,'count' => $count]);
        return $result;
    }

    public static function getClientProduct($sql){
        return db::getInstance()->Select($sql);
    }

}