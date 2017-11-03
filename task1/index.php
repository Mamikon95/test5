<?php

echo Multiplication(7,4);

/*
 * Функция для умножения чисел
 * @param $number1 - Первое число умножения
 * @param $number2 - Второе число умножения
 * @return integer
 * */
function Multiplication($number1,$number2) {
	
	$mult = 0;
	
    for($i = 0; $i < abs($number1); $i++) {
        $mult += abs($number2);
    };
	
	$mult = (number_gmp_sign($number1) != number_gmp_sign($number2)) ? (0 - $mult) : $mult;

    return $mult;
}

function number_gmp_sign($number) {
    return $number >= 0 ? true : false;
}