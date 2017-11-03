<?php

echo Multiplication(7,4);

/*
 * Функция для умножения чисел
 * @param $number1 - Первое число умножения
 * @param $number2 - Второе число умножения
 * @return integer
 * */
function Multiplication($number1,$number2) {
    for($mult = 0; $number1 > 0; $number1--) {
        $mult += $number2;
    };

    return $mult;
}