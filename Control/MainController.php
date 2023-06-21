<?php
session_start();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('./Backend/Animal.php');
require_once('./Backend/Helpers.php');
require_once("./Backend/Production.php");

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
    case '/farm/production':
        include './Front/navbar.php';
        include './Front/production.php';
        break;
    case '/farm/production/add':
        $csv = [];

        if ($_FILES['csv']['error'] == 0) {
            $name = $_FILES['csv']['name'];
            $type = $_FILES['csv']['type'];
            $tmpName = $_FILES['csv']['tmp_name'];
            $tmp = explode('.', $name);
            $ext = strtolower(end($tmp));
            $handle;

            if ($ext == 'csv') {
                $handle = fopen($tmpName, 'r');

                if ($handle = fopen($tmpName, 'r') !== FALSE) {
                    $tmpName = $_FILES['csv']['tmp_name'];

                    $csv_data = array_map('str_getcsv', file($tmpName));

                    array_walk($csv_data, function (&$x) use ($csv_data) {
                        $x = array_combine($csv_data[0], $x);
                    });

                    array_shift($csv_data);

                    $production = new Production();
                    $xx = $production->enter_production($csv_data);

                    if ($xx === true) {
                        http_response_code(200);
                        echo json_encode(["message" => "update successfuly"]);
                    } else {
                        http_response_code(400);
                        echo json_encode(["message" => "some error occured"]);
                    }
                } else {
                    http_response_code(400);
                    echo json_encode(["message" => "can't open the file"]);
                }
            } else {
                http_response_code(400);
                echo json_encode(["message" => "wrong file format"]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "something wrong occured"]);
        }

}
?>

