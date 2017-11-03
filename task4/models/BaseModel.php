<?php

/*
 * Подключаем зависимости
 * */

/*Класс для работы с пользователем*/

class BaseModel //extends От общего контроллера
{
    /*
      * Заносим данные в модель
      * @array $data - Заносимые данные
      * @return boolean
      * */
    public function load($data = []) {
        //Для форм строго название инпута - название свойства в модели
        foreach($data as $key => $item) {
            $this->{$key} = htmlspecialchars(strip_tags(trim($item)));
        }
    }
}