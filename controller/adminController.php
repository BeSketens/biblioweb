<?php

class Admin {

    private object $dbRemote;

    public function __construct($database)
    {
        $this->dbRemote = $database;
    }

    public function runScript()
    {
        if (!IS_CONNECTED || (IS_CONNECTED && $_SESSION['status'] != 'admin')) {
            header('Location: ' . DOMAIN);
            exit();
        }

        switch ($_SESSION['adminTarget']) {
            case 'author' :
                switch ($_SESSION['adminAction']) {
                    case 'add':
                        if (isset($_POST['add-author-submit'])){

                            $errorMsg = $this->processAddAuthor();

                            if (empty($errorMsg)) $successMsg = 'Auteur ajouté !';

                        }

                        require VIEW_PATH . "admin_authors.php";
                        break;
                    case 'modify' :

                        if (!$_SESSION['adminTargetId']) { # no valid target
                            header('Location: ' . DOMAIN . 'admin');
                            exit();
                        }
                        $id = $_SESSION['adminTargetId'];

                        if (isset($_POST['modify-author-submit'])) {

                            $errorMsg = $this->processModifyAuthor($id);

                            if (empty($errorMsg)) $successMsg = 'Auteur Modifié !';

                        }

                        $author = $this->dbRemote->getAuthor($id);

                        require VIEW_PATH . "admin_authors.php";
                        break;
                    case 'delete':
                        if (!$_SESSION['adminTargetId']) { # no valid target
                            header('Location: ' . DOMAIN . 'admin');
                            exit();
                        }
                        $id = $_SESSION['adminTargetId'];

                        $isAuthorDeleted = $this->processDeleteAuthor($id);

                        if ($isAuthorDeleted) {
                            header('location: ' . DOMAIN . 'admin?success=AuthorDeleted');
                        } else {
                            header('location: ' . DOMAIN . 'admin?error=');
                        }
                        exit();
                        break;
                    default : # wrong adminAction
                        header('Location: ' . DOMAIN . 'admin');
                        exit();
                }
                break;
            case 'member' :
                echo '';
                break;
            default :
                $members = $this->dbRemote->getMembers();
                $authors = $this->dbRemote->getAuthors();
                require VIEW_PATH . 'admin.php';
                break;
        }

    }

    private function processAddAuthor()
    {
        $lastname = htmlspecialchars($_POST['lastname']);
        $firstname = htmlspecialchars($_POST['firstname']);
        $nationality = htmlspecialchars($_POST['nationality']);

        if (empty($lastname) || empty($firstname) || empty($nationality)) return 'Remplissez tous les champs';
        if (strlen($lastname) > 30) return 'Le nom ne peut dépasser 30 charactères';
        if (strlen($firstname) > 30) return 'Le prénom ne peut dépasser 30 charactères';
        if (strlen($nationality) > 30) return 'La nationalité ne peut dépasser 30 charactères';

        $isAuthorModified = $this->dbRemote->addAuthor($lastname, $firstname, $nationality);

        return $isAuthorModified ? '' : 'Une erreur est survenue lors de l\'ajout';
    }

    private function processModifyAuthor($authorId): string
    {
        $lastname = htmlspecialchars($_POST['lastname']);
        $firstname = htmlspecialchars($_POST['firstname']);
        $nationality = htmlspecialchars($_POST['nationality']);

        if (empty($lastname) && empty($firstname) && empty($nationality)) return 'Remplissez au moins un champ';
        if (strlen($lastname) > 30) return 'Le nom ne peut dépasser 30 charactères';
        if (strlen($firstname) > 30) return 'Le prénom ne peut dépasser 30 charactères';
        if (strlen($nationality) > 30) return 'La nationalité ne peut dépasser 30 charactères';

        $isAuthorModified = $this->dbRemote->modifyAuthor($lastname, $firstname, $nationality, $authorId);

        return $isAuthorModified ? '' : 'Une erreur est survenue lors de la modification';
    }

    private function processDeleteAuthor($id)
    {
        return $this->dbRemote->deleteAuthor($id);
    }

}