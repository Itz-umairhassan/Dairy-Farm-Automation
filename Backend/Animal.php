<?php

require_once('./Backend/DBConnection.php');

class Animal
{
    private $id;
    private $specie;
    private $unhealthy;
    private $milk_production;
    private $recent_feed;

    private $db;
    public function __construct()
    {
        $this->db = new DataBase();
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

            return $ans;
        } else {
            return false;
        }
    }


    // Get all animals and their record from data base...
    public function get_animals()
    {
        $conn = $this->db->make_connection();

        if ($conn) {
            $sql = "select * from animal";

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
                        "pg" => $row['pregnant']
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
                mysqli_close($conn);
                return true;
            } else {
                return false;
            }

        }
        
        return false;
    }

}
?>

