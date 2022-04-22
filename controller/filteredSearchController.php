<?php 

class FilteredSearch {

    private $dbRemote;

    public function __construct($database)
    {
        $this->dbRemote = $database;
    }

    public function runScript()
    {

        isset($_SESSION['filter']) ? $keyword = htmlentities($_SESSION['filter']) : $keyword = false;

        if ($keyword) {
            $books = $this->dbRemote->getFilteredBooks($keyword);
        }
        
        require VIEW_PATH . 'filteredSearch.php';
    }

}