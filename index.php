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

isset($_GET['action']) ? $action = htmlspecialchars($_GET['action']) : $action = false;
isset($_GET['key']) ? $_SESSION['filter'] = htmlspecialchars($_GET['key']) : $_SESSION['filter'] = null;

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

$array = (array) $db; # to check if database link exists
if ($array[array_key_first($array)] != null) {
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
    
} else { # if error while trying to get db access
    require VIEW_PATH . 'databaseError.php';
}