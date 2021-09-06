<?php
class Controller{

    public $title;
    public $keywords;
    public $description;
    public $twig;
    protected $vars = [];
    protected $template;

    function __construct(){

        $loader = new \Twig\Loader\FilesystemLoader(Config::get('path_templates')."/");
        $this->twig = new \Twig\Environment($loader, [
            'cache' => '/path/to/compilation_cache',
            'auto_reload' => true,
            'autoescape' => false
        ]);
    }

    public function renderOutput(){

        if(empty($_SESSION['login'])){
            $this->vars['menu'] = $this->twig->render('layouts/menu.tpl');
        }else{
            $this->vars['menu'] = $this->twig->render('layouts/clientMenu.tpl');
        }


        $this->vars['title'] = $this->title;
        $this->vars['keywords'] = $this->keywords;
        $this->vars['description'] = $this->description;

        $this->vars['footer'] = $this->twig->render('layouts/footer.tpl');
        return $this->twig->render($this->template,$this->vars);
    }

}