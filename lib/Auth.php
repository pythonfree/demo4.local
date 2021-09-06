<?php
class Auth
{
    private static $_instance = null;

    /*
    * Получаем объект для работы с БД
    */
    public static function getInstance()
    {
        if (self::$_instance == null) {
            self::$_instance = new Auth();
        }
        return self::$_instance;
    }

    /*
    * Запрещаем копировать объект
    */
    private function __construct(){
    }
    private function __sleep(){
    }
    private function __wakeup(){
    }
    private function __clone(){
    }

    /*
    * Выполняем соединение с базой данных
    */
    static function is_auth(){
        if(!empty($_SESSION['login'])){
            return true;
        }else{
            return false;
        }
    }


    static function getRole(){
        if(self::is_auth()){
            return $_SESSION['login']['role'];
        }else{
            return false;
        }
    }


    static function getDataAccount(){
        if(self::is_auth()){
            return $_SESSION['login'];
        }else{
            return false;
        }
    }

    static function getUserId(){
        if(self::is_auth()){
            return $_SESSION['login']['id'];
        }else{
            return false;
        }
    }
}