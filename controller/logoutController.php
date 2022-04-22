<?php

class Logout {

    public function __construct(){}

    public function runScript()
    {
        session_unset();
        session_destroy();

        header('Location: ' . DOMAIN);
        exit();
    }

}
