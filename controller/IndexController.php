<?php

class IndexController extends    Controller {

    public function __construct()
    {
        parent::__construct();
        //Определяем основной шаблон контроллера
        $this->template = 'index.tpl';
        $this->title = "Главная страница";

    }
    public function index(){
        $this->vars['content'] = 'Содержимое главной страницы...';
        return $this->renderOutput();
    }


}