<?php
class CabinetController extends Controller {

    public function __construct(){
        $this->isAuth();
        parent::__construct();
        $this->template = 'index.tpl';
    }

    public function index(){

        $this->title = 'Личный кабинет';
        $auth = Auth::getDataAccount();

        $this->vars['content'] = $this->twig->render('cabinetClientInfo.tpl',['title' =>  $this->title,'auth' => $auth]);

        return $this->renderOutput();

    }


    public function isAuth(){
        if(empty($_SESSION['login'])){
            header('Location: /autorisation/?action=login');
        }
    }

}