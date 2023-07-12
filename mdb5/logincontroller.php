<?php

require_once('./user.php');
if (!empty($_REQUEST['name'])) {

    $name = $_REQUEST['username'];
    $password = $_REQUEST['password'];

    $user = new user();

    if ($user->verify_user($name, $password)) {
        http_response_code(200);
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $_SESSION['type'] = "user";

        echo "Correct";
    } else {
        http_response_code(400);
        echo "Wrong";
    }
} else {
    http_response_code(500);
    echo "Nothing";
}
?>

