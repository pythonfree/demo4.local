<?php

class GalleryController extends Controller {


    public function __construct()
    {
        parent::__construct();
        //Определяем основной шаблон контроллера
        $this->template = 'index.tpl';
    }

    public function index(){
            $gallery = GalleryModel::getAll();
            $this->vars['content'] = $this->twig->render('galleryContent.tpl',['gallery' => $gallery]);
            return $this->renderOutput();
    }

    public function show($get){
        $id = (int)$get['id'];
        $image = GalleryModel::getOne($id);
        $this->vars['content'] = $this->twig->render('galleryOne.tpl',['image' => $image]);
        return $this->renderOutput();
    }

}