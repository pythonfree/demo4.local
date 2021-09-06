<?php

class UserModel extends Model {

    protected static $table = 'users';

    protected static function setProperties(){}


    public static function create($name,$login,$password,$role = 2){
        return db::getInstance()->Query(
            'INSERT INTO `users`(`name`, `login`, `password`, `role`) VALUES (:name,:login,:password,:role)',
            [
                'name' => $name,
                'login' => $login,
                'password' => $password,
                'role' => $role
            ]
        );
    }

    //Проверяем логин на существования
    public static function isLogin($login){
        return db::getInstance()->One(
            'SELECT * FROM '.self::$table.' WHERE login = :login',['login' => $login]);
    }

    //Сверяем логин и пароль с базой
    public static function validateLogin($login,$password){
        return db::getInstance()->One(
            'SELECT * FROM '.self::$table.' WHERE login = :login AND `password` = :password',['login' => $login,'password' => $password]);
    }

}