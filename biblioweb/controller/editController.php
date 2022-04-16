<?php 

class Edit {

    private $dbRemote;

    public function __construct($database)
    {
        $this->dbRemote = $database;
    }

    public function runScript()
    {
        isset($_GET['ref']) ? $reference = htmlentities($_GET['ref']) : $reference = false;
        $submissionReceived = isset($_POST['submit']);
        $error = '';

        if ($submissionReceived) {
            $error = $this->validateSubmission($reference);
        } 

        if ($reference) {
            $dataArray = $this->dbRemote->getAllBookData($reference);
        } else {
            $dataArray = ['error' => true];
        }

        if (empty($error) && $submissionReceived) {
            $dataArray = ['success' => true];
        }

        require VIEW_PATH . 'edit.php';
    }

    private function validateSubmission($reference)
    {

        $title = htmlspecialchars( $_POST['title']);
        $description = htmlspecialchars($_POST['description']);
        $cover = htmlspecialchars($_POST['cover_url']);
        $author = htmlspecialchars($_POST['author_id']);
        $ref = htmlspecialchars($_POST['ref']);

        if ($ref != $reference) {
            return 'Référence invalide !';
        }

        if (strlen($title) <= 0 || strlen($description) <= 0 || strlen($cover) <= 0 || $author <= 0) {
            return 'Remplissez tous les champs !';
        }

        if ($author <= 0) {
            return 'Auteur invalide';
        }

        return '';
    }

}