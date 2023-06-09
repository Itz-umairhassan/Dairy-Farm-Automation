<?php
session_start();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('./Backend/Animal.php');
require_once('./Backend/Helpers.php');
switch ($_SERVER['PATH_INFO']) {
    case '/login':
        include './Front/login.php';
        break;
    case '/login/verify':
        include './Control/LoginController.php';
        break;
    case '/farm/home':
        if (!isset($_SESSION['type'])) {
            header("Location: ../login");
        }
        include './Front/navbar.php';
        include './Front/home.php';
        break;
    case '/farm/home/overview':
        $animal = new Animal();
        $data = $animal->get_overview();
        if (!$data) {
            http_response_code(500);
            echo "some error occured";
        } else {
            echo json_encode($data);
        }
        break;
    case '/farm/animal':
        include './Front/navbar.php';
        include './Front/AnimalsView.php';
        break;
    case '/farm/animal/get_animals':
        $animal = new Animal();
        $help = new Helper();
        $arr = $help->parser($_SERVER['QUERY_STRING']);
        if (!isset($arr['type'])) {
            $arr['type'] = 'all';
        }

        $rss = $animal->get_animals($arr['type']);
        echo json_encode($rss);
        //include './Control/animalController.php';
        break;
    case '/farm/animal/add':
        include './Front/navbar.php';
        include './Front/addAnimal.php';
        break;
    case '/farm/animal/add/insert':
        include './Control/animalController.php';
        break;

}
?>

