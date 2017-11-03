<?php

/*
 * Подключаем зависимости
 * Так же наши модели для работы из /models/
 * */

/*Контроллер для работы с пользователем*/

class UserController //extends От общего контроллера
{
    /*
     * Экшн регистрации
     * */
    public function actionRegister() {
        if(isset($_POST['form'])) {
            $data = $_POST['form'];

            //Создаем объект модели регистрации
            $form = new RegisterForm();

            //Если в
            if($form->load($data) && $form->validate()) {

                $form->saveUser();

                return true; //По хорошему редирект
            }
        }
    }

    /*
     * Экшн авторизации
     * */
    public function actionLogin() {
        if(isset($_POST['form'])) {
            $data = $_POST['form'];

            $user = new User();

            //Если в
            if($user->load($data) && $user->validate() && $user->login()) {

                return true; //По хорошему редирект
            }
        }
    }

    /*
     * Экшн авторизации
     * */
    public function actionResetpassword() {
        if(isset($_POST['form'])) {
            $data = $_POST['form'];

            $user = new User();

            //Если в
            if($user->load($data) && $user->validate() && $user->reset()) {

                return true; //По хорошему редирект
            }
        }
    }
}