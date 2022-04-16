<?php 

class Home {

    private $dbRemote;

    public function __construct($database)
    {
        $this->dbRemote = $database;
    }

    public function runScript()
    {
        $books = $this->dbRemote->getAllBooks();

        require VIEW_PATH . 'home.php';
    }

}