<?php
require_once __DIR__.'/lib/autoload.php';

//Стартуем сессий
session_start();

//Singleton
class App{

    private static $autoloader;

    public static function init(){
        if (self::$autoloader == NULL)
            self::$autoloader = new self();

        return self::$autoloader;
    }

    private function __construct(){
        spl_autoload_register([$this,'autoloadClass']);

        date_default_timezone_set('Europe/Moscow');
        db::getInstance()->Connect(Config::get('db_user'), Config::get('db_password'), Config::get('db_base'));

        if (php_sapi_name() !== 'cli' && isset($_SERVER) && isset($_GET)) {
            self::web(isset($_GET['path']) ? $_GET['path'] : '');
        }

    }

    private function autoloadClass($class){
        $dirs = [
            'controller',
            'data/migrate',
            'lib',
            'lib/smarty',
            'lib/commands',
            'model/'
        ];
        $found = false;
        foreach ($dirs as $dir) {
            $fileName = __DIR__ . '/' . $dir . '/' . $class . '.php';
            if (is_file($fileName)) {
                include_once($fileName);
                $found = true;
            }
        }
        if (!$found) {
            throw new Exception('Unable to load ' . $class);
        }
        return true;
    }

    protected static function web($url)
    {
        $url = explode("/", $url);
        if (!empty($url[0])) {
            $_GET['page'] = $url[0];
            if (isset($url[1])) {
                if (is_numeric($url[1])) {
                    $_GET['id'] = $url[1];
                } else {
                    $_GET['action'] = $url[1];
                }
                if (isset($url[2])) {
                    $_GET['id'] = $url[2];
                }
            }
        }
        else{
            $_GET['page'] = 'Index';
        }

        if (isset($_GET['page'])) {
            $controllerName = ucfirst($_GET['page']) . 'Controller';
            $methodName = isset($_GET['action']) ? $_GET['action'] : 'index';
            $controller = new $controllerName();
            echo $controller->$methodName($_GET);
        }
    }

    private function __clone(){}
    private function __wakeup(){}

}


try{
    $start = App::init();
}
catch (PDOException $e){
    echo "DB is not available";
    var_dump($e->getMessage());
    var_dump($e->getTrace());
}
catch (Exception $e){
    echo $e->getMessage();
}