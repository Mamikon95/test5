<?php

require './classes/db.php';

$db = new Db();

//Получаем отфильтрованные книги
$books = $db->getBooksByFilter();

//Выводим книги
foreach($books as $book) {
    echo 'Book name: '.$book['name'].'<br>';
    echo 'Count authors: '.$book['authors_count'].'<br>';
    echo '------------------------------------------------<br>';
}