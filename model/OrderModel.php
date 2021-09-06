<?php

class OrderModel extends Model {

    protected static $table = 'orders';

    protected static function setProperties(){}

    public static function create($userId,$address,$date_create,$status){

        $result =  db::getInstance()->Query(
            'INSERT INTO `orders`(`userId`,`address`,`date_create`,`status`) VALUES (:userId,:address,:date_create,:status)',
            [
                'userId' => $userId,
                'address' => $address,
                'date_create' => $date_create,
                'status' => $status
            ]
        );

        $order_id = db::getInstance()->lastId();

        $data = BasketModel::getAllProductBasket(array_keys($_COOKIE["cart"]));

        $readySlq = [];

        foreach ($data as $k => $v){
            $readySlq[$k]['orderId'] = $order_id;
            $readySlq[$k]['productId'] = $v['id'];
            $readySlq[$k]['price'] = $v['price'];
            $readySlq[$k]['amount'] = $v['count'];
        }

        $orderProduct = OrderProductModel::create($readySlq);

        return $orderProduct;
    }

   static function getClientOrders(){

        $id = Auth::getUserId();

        $orders = db::getInstance()->Select(
            'SELECT * FROM '.self::$table.' WHERE userId = :userId and status  NOT IN (2) ORDER BY `date_create` DESC',['userId' => $id]);


       if(!count($orders)){
           return false;
       }

       $result = '';
       $readySql = '';

       //формируем запрос
       for($i=0;$i < count($orders);++$i){

           $orderId = $orders[$i]['id'];

           if($i == 0){
               $readySql.="
			SELECT *, `op`.`price` FROM `orders_products` as op
			JOIN `products` as p ON `p`.`id` = `op`.`productId`
			WHERE `op`.`orderId` = $orderId
		";
           }else{
               $readySql.= " UNION SELECT *, `op`.`price` FROM `orders_products` as op
			JOIN `products` as p ON `p`.`id` = `op`.`productId`
			WHERE `op`.`orderId` = $orderId";
           }
       }

       $ordersProducts = ProductModel::getClientProduct($readySql);

       $readyArray = [];

       foreach ($ordersProducts  as $k => $v){
           $readyArray[$v['orderId']]['order'][] = $v;
       }

       foreach ($orders as $k => $o){
           $readyArray[$o['id']]['status'] = $o['status'];
       }

       return $readyArray;

    }

     static function updateStatus($orderId, $newStatus){

        $orderId = (int)$orderId;
        $newStatus = (int)$newStatus;

         $result =  db::getInstance()->Query(
             'UPDATE `orders` SET `status`= :newStatus WHERE `id` = :orderId',
             [
                 'orderId' => $orderId,
                 'newStatus' => $newStatus
             ]
         );

         return $result;
     }
}