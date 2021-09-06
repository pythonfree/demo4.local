<?php
class OrderController extends Controller {

    public function __construct()
    {
        parent::__construct();
        //Определяем основной шаблон контроллера
        $this->template = 'orderClient.tpl';
    }


    public function index($get){
        $status = $get['status'];
        $this->vars['content'] = $this->twig->render('orderContent.tpl',['status' => $status]);
        return $this->renderOutput();
    }



    public function client($get){
        $orders = OrderModel::getClientOrders();
        $this->vars['content'] = $this->renderClient($orders);
        return $this->renderOutput();
    }



    public function create(){
        $address = trim($_POST['address']);
        $date = date('Y-m-d h:i:s',time());
        $userId = Auth::getUserId();
        $status = 1;
        $order = OrderModel::create($userId,$address,$date,$status);

        if($order){
            if(BasketModel::clearBasket()){
                header('Location: /order/?status=success');
            }else{
                header('Location: /order/?status=error');
            };
        }else{
            header('Location: /order/?status=error');
        }

    }


    //Отмена заказа
    public function remove(){

                $id = (int)$_POST['id'];
                header('Content-Type: application/json');

                if(OrderModel::updateStatus($id,2)){
                    $response = "<div class='alert alert-success' role='alert'>
                      Заказ № $id успешно отменен!</div>";

                        echo json_encode([
                            'error' => false,
                            'error_text' => null,
                            'data' => $response
                        ]);

                }else{
                       echo json_encode([
                        'error' => false,
                        'error_text' => null,
                        'data' => $id
                    ]);

                };

    }

    public function renderClient($array){


        if(empty($array)){

           return $this->twig->render('orderEmpty.tpl',[]);

        }

        $readyHtml = '';

        $totalSum = '';
        $price = '';
        $image = '';
        $description = '';
        $status = '';

        $totalSum = '';

        $readyHtmlOrder = '';

        foreach ($array as $key => $value){

            $totalSum = 0;
            $readyTr = '';

            foreach ($value['order'] as $product){

                $totalSum+= $product['price'] * $product['amount'];

                $readyTr.= $this->twig->render('oneClientTr.tpl',[
                    'name' => $product['name'],
                    'price' => $product['price'],
                    'image' => $product['images'],
                    'amount' => $product['amount'],
                ]);

            }

            $readyHtmlOrder.= $this->twig->render('oneClientOrder.tpl',[
                'order' => $key,
                'content' => $readyTr,
                'total' => $totalSum,
                'status' => $this->getStringStatus($value['status'])
            ]);
        }

        return $readyHtmlOrder;
    }

    function getStringStatus($id){
        $status = [
            1 => 'Не оработан',
            2 => 'Отменен',
            3 => 'Оплачен',
            4 => 'Доставлен',
        ];
        return $status[$id];
    }


}