<?php

session_start();

require_once('./Backend/Animal.php');
require_once('./Backend/Helpers.php');
require_once("./Backend/Production.php");
require_once("./Backend/Sales.php");
require_once("./Backend/Feed.php");

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
    case '/farm/animal/details':
        include './Front/navbar.php';
        include './Front/animalDetails.php';
        break;
    case '/farm/animal/details/get':
        if (isset($_REQUEST['animal_id'])) {
            $animal = new Animal();

            $xx = $animal->get_one_animal_detail($_REQUEST['animal_id']);
            if (!$xx) {
                http_response_code(400);
                echo json_encode(["message" => "Wrong id or something"]);
            } else {
                http_response_code(200);
                echo json_encode($xx);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Not allowed to access"]);
        }
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

            if ($ext == 'json') {
                http_response_code(200);
                $content = json_decode(file_get_contents($tmpName), true);

                //print_r($content['data']);
                $production = new Production();
                $xx = $production->enter_production($content['data']);
                $_SESSION['recalculate'] = 'yes';
                if ($xx === true) {

                    http_response_code(200);
                    echo json_encode(["message" => "Updates successfuly"]);
                } else {
                    http_response_code(400);
                    echo json_encode(["message" => "Not Updated"]);
                }

                // below written code is for a csv file handling.....

                // $handle = fopen($tmpName, 'r');

                // if ($handle = fopen($tmpName, 'r') !== FALSE) {
                //     $tmpName = $_FILES['csv']['tmp_name'];

                //     $csv_data = array_map('str_getcsv', file($tmpName));

                //     array_walk($csv_data, function (&$x) use ($csv_data) {
                //         $x = array_combine($csv_data[0], $x);
                //     });

                //     array_shift($csv_data);

                //     $production = new Production();
                //     $xx = $production->enter_production($csv_data);

                //     if ($xx === true) {
                //         http_response_code(200);
                //         echo json_encode(["message" => "update successfuly"]);
                //     } else {
                //         http_response_code(400);
                //         echo json_encode(["message" => "some error occured"]);
                //     }
                // } else {
                //     http_response_code(400);
                //     echo json_encode(["message" => "can't open the file"]);
                // }


            } else {
                http_response_code(400);
                echo json_encode(["message" => "wrong file format " . $ext]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "something wrong occured"]);
        }

        break;
    case '/farm/sales/display':
        if (isset($_SESSION['sales'])) {
            $rss = $_SESSION['sales'];
            $message = "from session";
            echo json_encode(["message" => $message, "data" => $rss]);
        } else {
            $sales = new Sales();
            $sales_data = $sales->get_total_Sales();
            $_SESSION['sales'] = $sales_data;
            echo json_encode(["message" => "from calculation", "data" => $sales_data]);
        }
        break;
    case '/farm/sales/get':
        $sales = new Sales();
        $arr = $sales->calculate_pending_sales();

        // now set it into the session ...
        $_SESSION['sales'] = json_encode($arr);


        echo $_SESSION['sales'];
        $_SESSION['recalculate'] = 'no';
        break;
    case '/farm/sales/sold':
        $sales = new Sales();

        if (isset($_REQUEST['date']) && isset($_REQUEST['price']) && isset($_REQUEST['agent'])) {
            $date = $_REQUEST['date'];
            $price = $_REQUEST['price'];
            $agent = $_REQUEST['agent'];

            $details = $sales->get_details_of_pending($date);

            $xx = $sales->Insert_Sales($details, $price, $agent);

            if ($xx) {

                // now set stored sales of session to none so that we can recalculate it.
                $_SESSION['sales'] = null;

                http_response_code(200);
                echo json_encode(["message" => "Ok"]);
            } else {
                http_response_code(400);
                echo json_encode(["message" => "No"]);
            }

        } else {
            http_response_code(400);
            echo json_encode(["message" => "Access is not allowed"]);
        }
        break;

    case '/farm/feed':
        include './Front/navbar.php';
        include './Front/Feed.php';
        break;

    case '/farm/feed/add':
        include './Front/navbar.php';
        include './Front/addFeed.php';
        break;
    case '/farm/feed/get':

        $feed = new Feed();
        $feeds = $feed->Get_Feeds();
        echo json_encode(["data" => $feeds]);
        break;
    case '/farm/feed/add/insert':
        $feed = new Feed();
        if (isset($_POST['name']) && isset($_POST['price'])) {
            $quantity = $_POST['quantity'];
            $result = $feed->Insert_Feed($_POST['name'], $_POST['price'], isset($quantity) ? $quantity : null);
            $array = ["Feed Not Added", "Finance Not Added"];

            if ($result[0]) {
                $array[0] = "Feed Added";
            }

            if ($result[1]) {
                $array[1] = "Finance Added";
            }

            http_response_code(200);
            echo json_encode(["message" => $array]);

        } else {
            http_response_code(401);
            echo json_encode(["message" => "Unauthorized access"]);
        }
        break;

}
?>

