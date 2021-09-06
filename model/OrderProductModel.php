<?php

class OrderProductModel extends Model {

    protected static $table = 'orders_products';

    protected static function setProperties(){}


    public static function create($array){

        $ready_values = [];

        foreach($array as $p){
            $mask[] = '(?,?,?,?)';
            $ready_values = array_merge($ready_values, array_values($p));
        }

        $sql  = "INSERT INTO `orders_products`(`orderId`,`productId`,`price`,`amount`) VALUES" .implode(',', $mask);
        return db::getInstance()->Query($sql, $ready_values);
    }





}