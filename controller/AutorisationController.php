<?php
class AutorisationController extends Controller {

    public function __construct()
    {
        parent::__construct();
        //Определяем основной шаблон контроллера
        $this->template = 'index.tpl';
    }

    public function auth(){

        $login = trim($_POST['login']);
        $password = trim($_POST['password']);
        $password =  password_hash($password, PASSWORD_BCRYPT, ['salt' => Config::get('salt')]);

        $user = UserModel::validateLogin($login,$password);

        header('Content-Type: application/json');

        //если пользователь найден. Записываем его в сессию
        if(!empty($user)) {
            $_SESSION['login'] = $user;
            echo json_encode(['error' => false,'text' => 'Регистрация прошла успешно!']);
        } else {
            echo json_encode(['error' => true,'text' => 'Вы ввели не верный пароль или логин!']);
        }

    }


    public function login(){

        if(!empty($_SESSION['login'])){
            header('Location: /cabinet/');
        }

        $gallery = GalleryModel::getAll();
        $this->vars['content'] = $this->twig->render('login.tpl',[]);
        return $this->renderOutput();

    }


    public function registration(){

        if(!empty($_SESSION['login'])){
            header('Location: /autorisation/?action=login');
        }

        $gallery = GalleryModel::getAll();
        $this->vars['content'] = $this->twig->render('registration.tpl',[]);
        return $this->renderOutput();
    }

    public function logout(){
        session_destroy();
        header('Location: /');
    }


    public function create(){

        $name = $_POST['name'];
        $login = trim($_POST['login']);
        $password = trim($_POST['password']);
        $password =  password_hash($password, PASSWORD_BCRYPT, ['salt' => Config::get('salt')]);

        $validateLogin = UserModel::isLogin($login);

        header('Content-Type: application/json');

        if(!empty($validateLogin)){
            echo json_encode(['error' => true,'text' => 'Такой логин уже существует!']);
        }else{
            $res = UserModel::create($name,$login,$password);
            if($res){
                echo json_encode(['error' => false,'text' => 'Регистрация прошла успешно!']);
            }else{
                echo json_encode(['error' => true,'text' => 'Произошла ошибка при регистрации!']);
            }
        }

    }




}