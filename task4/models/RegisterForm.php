<?php

require 'BaseModel.php';

/*
 * Подключаем зависимости
 * Так же нашу модель юзеров для работы из /models/
 * */

/*Класс для работы с регистрацией*/

class RegisterForm extends BaseModel
{
    public $name;
    public $email;
    public $password;
    public $repeat_password;

    /*
     * метол для валидации
     * @return boolean
     * */
    public function validate() {

        //Условия для валдиации
        if(
            $this->password != $this->repeat_password ||
            strlen($this->name < 6) || strlen($this->name) > 255 ||
            strlen($this->password) < 6 || strlen($this->password) > 255 ||
            strlen($this->email) < 6 || strlen($this->email) > 255 ||
            !filter_var($this->email, FILTER_VALIDATE_EMAIL)
        ) {
            return false;
        } else {
            return true;
        }

    }

    /*
     * метол для сохранения пользователя
     * @return boolean
     * */
    public function saveUser() {
        $user = new User();

        //Заносим данные
        $user->name = $this->name;
        $user->setPassword($this->password);
        $user->generateToken();

        //Сохраняем объект
        return $user->save();
    }
}