<?php

class ExpertRoom {

    private $dbRemote;

    public function __construct($database)
    {
        $this->dbRemote = $database;
    }

    public function runScript()
    {
        if (!IS_CONNECTED || (IS_CONNECTED && $_SESSION['status'] != 'expert')) {
            header('Location: ' . DOMAIN);
            exit();
        }

        require VIEW_PATH . 'expertRoom.php';
    }
}