<?php

class GalleryModel extends Model {

    protected static $table = 'gallery';

    protected static function setProperties(){

    }

    public static function getAll(){
        return db::getInstance()->Select(
           'SELECT * FROM '.self::$table.'');
    }

    public static function getOne($id){
        return db::getInstance()->One(
            'SELECT * FROM '.self::$table.' WHERE id = :id',['id' => $id]);
    }
}