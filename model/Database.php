<?php

class Database {

    private static ?Database $instance = null;
    private PDO $db;

    private function __construct(){
        try {
            return $this->db = new PDO("mysql:host=" . SQL_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_USERNAME, DB_PASSWORD);
        } catch (Exception $e) {
            return null;
        }
    }

    public static function getInstance(): ?Database
    {
        if (is_null(self::$instance)) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getAllBooks(): bool|array
    {
        $request = $this->db->query('SELECT * FROM books ORDER BY title');

        return $request->fetchAll();
    }

    public function getFilteredBooks($filter): bool|array
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

    public function createUser($login, $email, $status, $pwd): bool
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

    public function getMembers(): bool|array
    {
        $request = $this->db->query('SELECT * FROM users');

        return $request->rowCount() >= 1 ? $request->fetchAll() : false;
    }

    public function getAuthors(): bool|array
    {
        $request = $this->db->query('SELECT * FROM authors');

        return $request->rowCount() >= 1 ? $request->fetchAll() : false;
    }

    public function getAuthor($id): bool|array
    {
        $request = $this->db->prepare('SELECT * FROM authors WHERE id = ?');
        $request->execute(array($id));

        return $request->fetch();
    }

    public function deleteAuthor(): bool
    {

        /*
         * Faut-il delete les livres des auteurs avec ou bien juste l'auteur ? Les livres n'auront donc plus d 'auteur -> erreurs incoming
         */

        return true;
    }

    public function addAuthor($lastname, $firstname, $nationality): bool
    {
        $request = $this->db->prepare('INSERT INTO authors (lastname, firstname, nationality) VALUES (?, ?, ?)');
        $request->execute(array($lastname, $firstname, $nationality));

        return $request->rowCount() == 1;
    }

    public function modifyAuthor($lastname, $firstname, $nationality, $authorId): bool
    {
        $update = empty($lastname) ? '' : ' lastname = "' . $lastname . '"';
        $update .= empty($firstname) ? '' : ' firstname = "' . $firstname . '"';
        $update .= empty($nationality) ? '' : ' nationality = "' . $nationality . '"';

        $request = $this->db->prepare('UPDATE authors SET ' . $update . ' WHERE id = ?');
        $request->execute(array($authorId));

        return $request->rowCount() == 1;
    }
}