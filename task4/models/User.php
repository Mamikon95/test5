<?php

require 'BaseModel.php';

/*
 * Подключаем зависимости\
 * Так же нашу модель юзеров для работы из /models/
 * */

/*Класс для работы с пользователем*/

class User extends BaseModel
{
    /*
     * TODO: Так как для теста то указал всего 2 параметра, на практике их больше
     * */
    public $name;
    public $email;
    public $password;
    public $auth_token;

    /*
     * метол для валидации
     * @return boolean
     * */
    public function validate() {

        //Условия для валдиации
        if(
            strlen($this->name < 6) || strlen($this->name) > 255 ||
            strlen($this->email) < 6 || strlen($this->email) > 255 ||
            !filter_var($this->email, FILTER_VALIDATE_EMAIL)
        ) {
            return false;
        } else {
            return true;
        }

    }

    /*
     * метод для сохранения юзера
     * @return boolean
     * */
    public function save() {
        // Пишем запрос для сохранения значений password и name в базу
        //Если всё хорошо то true
        return true;
    }

    /*
     * Установка пароля
     * @return boolean
     * */
    public function setPassword($password) {
        $this->password = md5($password);
        return true;
    }

    /*
     * Генерация токена
     * @return boolean
     * */
    public function generateToken() {
        $this->auth_token = uniqid(true); //На практике можно что то посложнее придумать
        return true;
    }

    /*
     * метод для авторизации пользователя
     * @return boolean
     * */
    public function login() {
        $password = md5($this->password);

        $sql = '';

        $user = $sql; // Запрос: Если в базе существует пользователь с таким хэш паролем и именем то берем его

        /*
         * Если нашли то в сессию записываем
         * TODO: По хорошему эта часть должны вынести в отдельный компонент, но тут модели и контроллер
         */
        if($user) {
            session_start();
            $_SESSION["user_token"] = $user['auth_token'];
        }

        return true;
    }

    /*
     * метод для восствновления пароля
     * @return boolean
     * */
    public function reset() {
        $email = $this->email;

        $sql = '';

        $user = $sql; // Запрос: Находим в базе пользователя по email

        /*
         * Если нашли то в сессию записываем
         * TODO: По хорошему эта часть должны вынести в отдельный компонент, но тут модели и контроллер
         */
        if($user) {
            //Новый пароль устанавливаем
            $password = uniq(true);

            $this->setPassword($password);
            $this->generateToken();

            if($this->save()) {
                //Отправляем на почту новый пароль
               if(mail($this->email,'Ваш новый пароль',$password)) {
                   return true;
               }
            }
        }

        return false;
    }

    /*
     * Проверяем имеет ли пользователь доступ к данной странице
     * @param $action - действие которое должно быть проверно
     * @param $url - относительый url, для которого проверяется действие
     * @return boolean
     * TODO: По хорошему это должно быть в отдельном компоненте управления пользователями RBAC
     * */
    public function can($action,$url) {
        $accept_action = 'Проверяем есть ли в таблице компетенций строка с таким действием и url'; // Берем кол-во

        return (bool)$accept_action;
    }
}