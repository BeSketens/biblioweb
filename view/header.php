<?php
date_default_timezone_set('Europe/Brussels');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?= DOMAIN ?>view/css/style.css">
    <title>Biblioweb</title>
</head>

<body>
    <header id="main-header">
        <div>
            <a href="<?= DOMAIN ?>">
                <h1>Biblioweb</h1>
            </a>
        </div>
        <nav>
            <?php
                if (!IS_CONNECTED){ ?>
                    <a href="<?= DOMAIN ?>create-account">Créer un compte</a>
                    <a href="<?= DOMAIN ?>login">Se connecter</a>
            <?php } else { # session set
                    if ($_SESSION['status'] == 'expert') { ?>
                        <a href="<?= DOMAIN ?>expert-room">Expert Room</a>
            <?php   } ?>
                    <a href="<?= DOMAIN ?>logout">Déconnexion</a>
            <?php } ?>
        </nav>
    </header>