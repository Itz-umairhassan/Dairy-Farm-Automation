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
        //include './Front/dietPlanDetails.php';

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

            if (!isset($_SESSION['has_plans']) || $_SESSION['has_plan'] != true) {
                $_SESSION['has_plan'] = true;
                $feed = new Feed();
                $_SESSION['plans'] = $feed->Get_Diet_Plans();
            }

            $index = 1;
            foreach ($_SESSION['plans'] as $single_plan) {
                if ($single_plan['planinformation'] != $xx["dietplan"][0]) {
                    $xx['dietplan'][$index++] = $single_plan['planinformation'];
                }
            }

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
                // $_SESSION['recalculate'] = true;
                if ($xx === true) {

                    // now recalculate the session values...
                    $arr = $sales->calculate_pending_sales();
                    $_SESSION['has_pending'] = true;
                    // now set it into the session ...
                    $_SESSION['pending_sales'] = $arr;

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
        $message = "from session";
        if (!isset($_SESSION['has_sales']) || $_SESSION['has_sales'] != true) {

            $sales = new Sales();
            $sales_data = $sales->get_total_Sales();
            $_SESSION['sales'] = $sales_data;
            $_SESSION['has_sales'] = true;
            $message = "from calc";

        }

        echo json_encode(["message" => $message, "data" => $_SESSION['sales']]);
        break;
    case '/farm/sales/get':
        $message = "from session";
        if (!isset($_SESSION['has_pending']) || $_SESSION['has_pending'] != true) {
            $sales = new Sales();
            $arr = $sales->calculate_pending_sales();
            $_SESSION['has_pending'] = true;
            // now set it into the session ...
            $_SESSION['pending_sales'] = $arr;
            $message = "calc";
        }

        echo json_encode(["message" => $message, "data" => $_SESSION['pending_sales']]);
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

                // now recalculate the session values...
                $arr = $sales->calculate_pending_sales();
                $_SESSION['has_pending'] = true;
                // now set it into the session ...
                $_SESSION['pending_sales'] = $arr;

                // ALSO UPDATE THE SALES HISTORY IN SESSION
                $sales_data = $sales->get_total_Sales();
                $_SESSION['sales'] = $sales_data;
                $_SESSION['has_sales'] = true;

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
        if (isset($_SESSION['feedthere']) && $_SESSION['feedthere'] == true) {
            echo json_encode(["message" => "from session", "data" => $_SESSION['feeds']]);
        } else {
            $feed = new Feed();
            $feeds = $feed->Get_Feeds();
            $_SESSION['feeds'] = $feeds;
            $_SESSION['feedthere'] = true;
            echo json_encode(["message" => "from calc", "data" => $feeds]);
        }
        break;
    case '/farm/feed/add/insert':
        $feed = new Feed();
        if (isset($_POST['name']) && isset($_POST['price'])) {
            $quantity = $_POST['quantity'];
            $result = $feed->Insert_Feed($_POST['name'], $_POST['price'], isset($quantity) ? $quantity : null);
            $array = ["Feed Not Added", "Finance Not Added"];

            if ($result[0]) {
                $array[0] = "Feed Added";
                $_SESSION['feedthere'] = false;
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
    case '/farm/plan':
        include './Front/navbar.php';
        include './Front/DietPlan.php';
        break;
    case '/farm/plan/get':
        if (isset($_SESSION['has_plan']) && $_SESSION['has_plan'] == true) {
            echo json_encode(["message" => "from session", "all_plans" => $_SESSION['plans']]);
        } else {
            $feed = new Feed();
            $all_plans = $feed->Get_Diet_Plans();
            $_SESSION['has_plan'] = true;
            $_SESSION['plans'] = $all_plans;
            echo json_encode(["message" => "from calc", "all_plans" => $all_plans]);
        }
        break;

    case '/farm/plan/add':
        include './Front/navbar.php';

        $helper = new Helper();
        $parsed = $helper->parser($_SERVER['QUERY_STRING']);
        $plan = [];
        $feed = new Feed();
        $plan_info = "";
        $temp_plan = [];

        if (isset($parsed['id'])) {
            $fetched_data = $feed->Get_Plan_By_Id($parsed['id']);
            // print_r($fetched_data);
            if (count($fetched_data) > 0) {
                $plan_info = $fetched_data[0];
                $temp_plan = $fetched_data[1];

                // now get all the current feeds and populate the form data with the data of this diet plan
                // or if feed was not in that diet plan then it will have 0 quantity...
                $feeds = [];
                if (isset($_SESSION['feedthere']) && $_SESSION['feedthere'] == true) {
                    $feeds = $_SESSION['feeds'];

                } else {
                    $feeds = $feed->Get_Feeds();
                }

                foreach ($feeds as $subarray) {
                    if (isset($temp_plan[$subarray['Name']])) {
                        $plan[$subarray['Name']] = $temp_plan[$subarray['Name']];
                    } else {
                        $plan[$subarray['Name']] = 0;
                    }
                }
            }

        } else {
            // if creating new plan then fetch the feeds...
            $feeds = [];
            if (isset($_SESSION['feedthere']) && $_SESSION['feedthere'] == true) {
                $feeds = $_SESSION['feeds'];

            } else {
                $feeds = $feed->Get_Feeds();
            }

            foreach ($feeds as $subarray) {
                $plan[$subarray['Name']] = 0;
            }
        }
        include './Front/addDietPlan.php';
        break;

    case '/farm/plan/add/insert':
        $data = json_decode($_POST['plan_details']);
        $information = $_POST['information'];
        $iid = $_POST['id'];
        $newplan = [];

        $skip = true;
        foreach ($data as $feed => $quantity) {
            if (!$skip) {
                $newplan[$feed] = $quantity;
            }

            $skip = false;
        }

        $feed = new Feed();
        $result = $feed->Create_plan($newplan, $iid, $information);

        if ($result[0] == 200) {
            $all_plans = $feed->Get_Diet_Plans();
            $_SESSION['has_plan'] = true;
            $_SESSION['plans'] = $all_plans;
        }

        http_response_code($result[0]);
        echo json_encode(["message" => $result[1]]);

        break;
    case '/farm/animal/planchange':
        if (isset($_POST['animalid'])) {

            $feed = new Feed();
            $ans = $feed->Change_Plan($_POST['animalid'], $_POST['newplan'], $_POST['oldplan']);

            if ($ans[0] == 200) {
                $all_plans = $feed->Get_Diet_Plans();
                $_SESSION['has_plan'] = true;
                $_SESSION['plans'] = $all_plans;
            }

            http_response_code($ans[0]);
            echo json_encode(["message" => $ans[1]]);
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Not allowed"]);
        }
        break;

}
?>

