<?php

require_once('./Backend/DBConnection.php');
require_once("./Backend/Production.php");

class Animal
{
    private $id;
    private $specie;
    private $unhealthy;
    private $milk_production;
    private $recent_feed;

    private $db;
    private $production;
    public function __construct()
    {
        $this->db = new DataBase();
        $this->production = new Production();
    }


    public function get_overview()
    {
        $conn = $this->db->make_connection();
        if ($conn) {
            $sql = "select * from animal";

            $res = mysqli_query($conn, $sql);
            $ans = array('total' => 0, 'healthy' => 0, 'unhealthy' => 0, 'pg' => 0);

            $xx = mysqli_num_rows($res);
            $ans['total'] = $xx;

            $health = 0;
            $pg = 0;
            if ($xx > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    if ($row['healthy']) {
                        $health += 1;
                    }
                    if ($row['pregnant']) {
                        $pg += 1;
                    }
                }
            }

            $ans['healthy'] = $health;
            $ans['pg'] = $pg;
            $ans['unhealthy'] = $xx - $health;
            $history = $this->production->get_production_history("days");

            $data = [
                'overview' => $ans,
                'history' => $history
            ];
            return $data;
        } else {
            return false;
        }
    }


    // Get all animals and their record from data base...
    public function get_animals($type)
    {
        $conn = $this->db->make_connection();

        if ($conn) {
            $sql = "select * from animal";
            if (strtolower($type) === 'healthy') {
                $sql .= ' where healthy=1';
            } else if (strtolower($type) === 'unhealthy') {
                $sql .= ' where healthy=0';
            } else if (strtolower($type) === 'pregnant') {
                $sql .= ' where pregnant=1';
            }

            $result = mysqli_query($conn, $sql);

            $xx = mysqli_num_rows($result);
            $ans = array();

            $idx = 0;
            if ($xx > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $ans[$idx] = [
                        "ID" => $row['id'],
                        "species" => $row["species"],
                        "price" => $row["price"],
                        "healthy" => $row["healthy"],
                        "group" => $row["grp"],
                        "pg" => $row['pregnant'],
                        "dietplan" => $row["DietPlan"]
                    ];

                    $idx += 1;
                }

                mysqli_close($conn);
                return $ans;
            } else {
                mysqli_close($conn);
                return -1;
            }
        } else {
            return false;
        }

    }

    // ADD A NEW ANIMAL TO THE DATABASE....
    public function add_animal($price, $species, $is_pregnant, $is_healthy, $group)
    {
        $conn = $this->db->make_connection();

        if ($conn) {
            $sql = "insert into animal (price,species,grp,healthy,pregnant) values(" . $price . ',\'' . $species . '\',\'' . $group . '\',' . $is_healthy . ',' . $is_pregnant . ')';


            if (mysqli_query($conn, $sql)) {
                // $last_id = mysqli_insert_id($conn);

                // $sql = "insert into production (animalid) values(" . $last_id . ")";
                // mysqli_query($conn, $sql);
                mysqli_close($conn);
                return true;
            } else {
                return false;
            }

        }

        return false;
    }

    public function get_production_per_animal($animal_id, $con)
    {
        $sql = "select * from production where animalid=" . $animal_id . " and DATE(date)>=DATE(NOW())-INTERVAL 30 DAY";

        $result = mysqli_query($con, $sql);

        $rows = mysqli_num_rows($result);
        if ($rows <= 0)
            return false;

        $ans = [];
        $ii = 0;

        while ($xx = mysqli_fetch_assoc($result)) {
            $ans[$ii] = [
                "date" => $xx['Date'],
                "milk" => $xx['milk']
            ];
            $ii++;
        }

        return $ans;
    }

    // find animal details for a given animal...
    public function get_one_animal_detail($animal_id)
    {
        $con = $this->db->make_connection();

        if ($con) {
            $sql = "select * from animal where id=" . $animal_id;

            $rss = ["id" => $animal_id, "price" => "1000", "group" => "G1", "healthy" => true, "preg" => false];

            $result = mysqli_query($con, $sql);

            $rows = mysqli_num_rows($result);

            if ($rows == 0) {
                mysqli_close($con);
                return false;
            }

            // otherwise fetch the data...
            $xx = mysqli_fetch_assoc($result);

            $rss["price"] = $xx["price"];
            $rss["species"] = $xx["species"];
            $rss["group"] = $xx["grp"];
            $rss["healthy"] = $xx["healthy"];
            $rss["pregnant"] = $xx["pregnant"];
            $rss["dietplan"] = [$xx["DietPlan"]];

            $ans = $this->get_production_per_animal($animal_id, $con);
            $rss['production'] = $ans === false ? [] : $ans;

            // now we want to get the production details of the animal...
            mysqli_close($con);
            return $rss;

        } else {
            return false;
        }
    }

}
?>

