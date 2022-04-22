<?php

class Account {

    private $dbRemote;

    public function __construct($database)
    {
        $this->dbRemote = $database;
    }

    public function runScript()
    {
        if (IS_CONNECTED) {
            header('Location: ' . DOMAIN);
            exit();
        }

        $isCreatingAccount = isset($_POST['submit']);
        $error = '';

        if ($isCreatingAccount) {
            $error = $this->createAccount();
        }

        require VIEW_PATH . 'accountCreation.php';
    }

    private function createAccount()
    {
        $username = htmlspecialchars($_POST['username']);
        $email = htmlspecialchars($_POST['email']);
        $pwd = htmlspecialchars($_POST['password']);
        $status = htmlspecialchars($_POST['status']);

        if (strlen($username) <= 0 || strlen($email) <= 0 || strlen($pwd) <= 0 || strlen($status) <= 0){
            return 'Remplissez tous les champs !';
        }

        if (strlen($username) > 30){
            return 'Votre nom d\'utlisateur ne peut dépasser 30 charactères';
        }

        $isAccountCreated = $this->dbRemote->createUser($username, $email, $status, $pwd);
        // var_dump($isAccountCreated);

        if ($isAccountCreated) {
            header('Location: ' . DOMAIN . 'login');
            exit();
        }

        return '';
    }

}
