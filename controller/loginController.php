<?php

class Login {

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

        $isLogingIn = isset($_POST['submit']);
        $error = '';

        if ($isLogingIn){
            $error = $this->login();
        }

        require VIEW_PATH . 'login.php';
    }

    private function login()
    {
        $email = htmlspecialchars($_POST['email']);
        $pwd = htmlspecialchars($_POST['password']);

        if (strlen($email) <= 0 || strlen($pwd) <= 0){
            return 'Remplissez tous les champs !';
        }

        $userAccount = $this->dbRemote->getUser($email);

        if (empty($userAccount)) {
            return 'Identifiant(s) de connexion erroné(s) !';
        }

        if (!password_verify($pwd, $userAccount['password'])) {
            return 'Identifiant(s) de connexion erroné(s) !';
        }

        $this->sessionInit($userAccount);

        header('Location: ' . DOMAIN);
        exit();

        return '';
    }

    private function sessionInit($user)
    {
        $_SESSION['connected'] = true;
        $_SESSION['id'] = $user['id'];
        $_SESSION['status'] = $user['statut'];
    }
}