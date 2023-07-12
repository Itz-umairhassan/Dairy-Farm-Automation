<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

echo $path;

switch ($path) {
    case '/mdb5/':
        include './Front/login.php';
        break;
    case 'mdb5/login/verify':
        include './LoginController.php';
        break;
    case '/user/home':
        if (!isset($_SESSION['type'])) {
            echo "No access permission for path: " . $path;
        } else {
            include './Front/home.php';
        }
        break;
    default:
        echo "No matching case found for path: " . $path;
}
?>






