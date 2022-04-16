<?php

class Database {

    private static $instance = null;
    private $db;

    private function __construct(){
        try {
            return $this->db = new PDO("mysql:host=" . SQL_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_USERNAME, DB_PASSWORD);
        } catch (Exception $e) {
            return null;
        }
    }

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getAllBooks()
    {
        $request = $this->db->query('SELECT * FROM books ORDER BY title');

        return $request->fetchAll();
    }

    public function getFilteredBooks($filter)
    {
        $filterTmp = "%" . $filter . "%";
        $request = $this->db->prepare('SELECT * FROM books WHERE title LIKE ? ORDER BY title');
        $request->execute(array($filterTmp));

        return $request->fetchAll();
    }

    public function getAllBookData($ref)
    {
        $request = $this->db->prepare('SELECT * FROM `books` INNER JOIN authors ON books.author_id=authors.id WHERE ref= ?');
        $request->execute(array($ref));

        return $request->fetch();
    }

    public function createUser($login, $email, $status, $pwd)
    {
        $passwordTmp = password_hash($pwd, CRYPT_BLOWFISH);
        $request = $this->db->prepare('INSERT INTO users (login, email, statut, password) VALUES (?, ?, ?, ?)');
        $request->execute(array($login, $email, $status, $passwordTmp));

        return $request->rowCount() >= 1;
    }

    public function getUser($email)
    {
        $request = $this->db->prepare('SELECT * FROM users WHERE email = ?');
        $request->execute(array($email));

        return $request->fetch();
    }
}