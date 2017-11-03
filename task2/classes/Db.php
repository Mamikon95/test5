<?php

/*Класс для работы с PDO*/

class Db {
    private $host = 'localhost';
    private $username = 'root';
    private $database = 'test5';
    private $password = '';

    /*
     * Объект класса подключения
     * */
    protected $connection;

    /*
     * Конструктор
     * */
    public function __construct() {
        try {
            $this->connection = new PDO("mysql:host={$this->host};dbname={$this->database}", $this->username, $this->password);
        } catch (Exception $e) {
            print_r($e->getMessage());
            exit;
        }
    }

    /**
     * Получаем список книг, написанных 3-мя со-авторами.
     * @return array
     */
    public function getBooksByFilter() {
        $sth = $this->connection->prepare("
                  SELECT book.*,COUNT(author_book.author_id) AS authors_count 
                  FROM author_book
                  LEFT JOIN book ON book.id = author_book.book_id
                  GROUP BY book.id
                  HAVING authors_count < 3;
                  
        ");
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
}