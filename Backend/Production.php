<?php
require_once('./Backend/DBConnection.php');

class Production
{
    private $db;

    public function __construct()
    {
        $this->db = new DataBase();
    }


    private function give_indexes($con, $production_array)
    {
        $indexes = [];

        $ff = 0;
        $ss = 0;
        foreach ($production_array[0] as $k => $v) {
            if ($ff === 0)
                $ff = $k;
            else
                $ss = $k;
        }

        $indexes[$ff] = $ss;

        foreach ($production_array as $subarray) {
            $animal_id = $subarray[$ff];
            $milk = $subarray[$ss];

            $indexes[$animal_id] = $milk;
        }

        return $indexes;

    }

    private function just_update($con, $indexes)
    {
        $times = 2;
        $date = date("y-m-d");

        foreach ($indexes as $animal_id => $milk) {
            $sql = "update production set milk=" . $milk . "+milk , times=" . $times . " where animalid=" . $animal_id . " and date='" . $date . "'";

            mysqli_query($con, $sql);
        }


        mysqli_close($con);
        return true;

    }

    public function enter_production($production_array)
    {
        $con = $this->db->make_connection();
        $date = date('y-m-d');
        $times = 1;
        $ii = 1;

        if (count($production_array) <= 0)
            return true;

        // determine the indexes by parsing the csv data...
        $indexes = $this->give_indexes($con, $production_array);

        if ($con) {


            // check if this date already exists if yes then just update...
            $sql = "select * from production where date='" . $date . "' limit 1";
            $result = mysqli_query($con, $sql);
            $xx = mysqli_num_rows($result);
            if ($xx > 0) {
                return $this->just_update($con, $indexes);
            }

            // otherwise insert the new data for production...
            foreach ($indexes as $k => $v) {
                // $sql = "update production set milk=" . $v . "*milk , times=" . $times . ", date='" . $date . "' where animalid= " . $k;
                $sql = "insert into production (animalid,date,times,milk) values(" . $k . ",'" . $date . "'," . $times . "," . $v . ")";
                mysqli_query($con, $sql);

            }

            mysqli_close($con);
            return true;


        } else {
            return false;
        }
    }
}
?>

