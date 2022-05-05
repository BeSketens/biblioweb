<?php
#error_reporting(0);

require 'config.php';

############################################################################### IS USER CONNECTED

session_start();
define("IS_CONNECTED", isset($_SESSION['connected']));

############################################################################### Db link

require MODEL_PATH . 'Database.php';
$db = Database::getInstance();

############################################################################### MAIN

$action = isset($_GET['action']) ? htmlspecialchars($_GET['action']) : false;
$_SESSION['filter'] = isset($_GET['key']) ? htmlspecialchars($_GET['key']) : false;

switch ($action) {
    case false:
        require CONTROLLER_PATH . 'homePageController.php';
        $controller = new Home($db);
        break;
    case 'filter':
        require  CONTROLLER_PATH . 'filteredSearchController.php';
        $controller = new FilteredSearch($db);
        break;
    case 'edit' :
        require CONTROLLER_PATH . 'editController.php';
        $controller = new Edit($db);
        break;
    case 'login':
        require CONTROLLER_PATH . 'loginController.php';
        $controller = new Login($db);
        break;
    case 'create-account':
        require CONTROLLER_PATH . 'accountCreationController.php';
        $controller = new Account($db);
        break;
    case 'admin' :
        require CONTROLLER_PATH . 'adminController.php';
        $controller = new Admin($db);

        if (isset($_GET['author']) && isset($_GET['authorAction'])) { # actions on authors

            $_SESSION['adminTarget'] = "author";
            $_SESSION['adminAction'] = htmlspecialchars($_GET['authorAction']);
            $_SESSION['adminTargetId'] = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : false;

        } elseif (isset($_GET['members']) && isset($_GET['authorAction'])) { # actions on members

            $_SESSION['adminTarget'] = "member";
            $_SESSION['adminAction'] = htmlspecialchars($_GET['authorAction']);
            $_SESSION['adminTargetId'] = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : false;

        } else {

            $_SESSION['adminTarget'] = false;
            $_SESSION['adminAction'] = false;

        }

        break;
    case 'expert-room':
        require CONTROLLER_PATH . 'expertRoomController.php';
        $controller = new ExpertRoom($db);
        break;    
    case 'logout':
        require CONTROLLER_PATH . 'logoutController.php';
        $controller = new Logout();
        break;        
}

############################################################################### View load

try {
    if (isset($controller)) {

        # header
        require VIEW_PATH . 'header.php';

        # run controller -> run view
        $controller->runScript();

        # footer
        require VIEW_PATH . 'footer.php';

    } else { # wrong action == wrong url

        require VIEW_PATH . 'wrongUrl.php';

    }
    
} catch (Error) { # if any errors occured
    require VIEW_PATH . 'error.php';
}
