<?php 

class FilteredSearch {

    private $dbRemote;

    public function __construct($database)
    {
        $this->dbRemote = $database;
    }

    public function runScript()
    {

        isset($_POST['key']) && !empty($_POST['key']) ? $keyword = htmlentities($_POST['key']) : $keyword = false;

        if ($keyword) {
            $books = $this->dbRemote->getFilteredBooks($keyword);
        }
        
        require VIEW_PATH . 'filteredSearch.php';
    }

}