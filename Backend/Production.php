<?php
require_once('./Backend/DBConnection.php');
require_once("./Backend/Sales.php");

class Production
{
    private $db;
    private $sales;

    public function __construct()
    {
        $this->db = new DataBase();
        $this->sales = new Sales();
    }


    private function give_indexes($con, $production_array)
    {
        $indexes = [];

        foreach ($production_array as $subarary) {
            $animal_id = $subarary['id'];
            $milk = (int) $subarary['milk'];
            $indexes[$animal_id] = $milk;
        }

        return $indexes;


        // this below code was written for csv file......

        // $indexes = [];

        // $ff = 0;
        // $ss = 0;
        // foreach ($production_array[0] as $k => $v) {
        //     if ($ff === 0)
        //         $ff = $k;
        //     else
        //         $ss = $k;
        // }

        // $indexes[$ff] = $ss;

        // foreach ($production_array as $subarray) {
        //     $animal_id = $subarray[$ff];
        //     $milk = $subarray[$ss];

        //     $indexes[$animal_id] = $milk;
        // }

    }

    // ANIMAL GROUPS RELATED CALCULATIONS ON EACH PRODUCTION ENTRY
    public function Group_Recalculation($id, $milk, $con)
    {
        $query = "select * from animal where id=" . $id;
        $result = mysqli_query($con, $query);
        $xx = mysqli_num_rows($result);

        if ($xx > 0) {
            $row = mysqli_fetch_assoc($result);

            if ($row['day'] == 5) {
                $previous_yield = $row['calculation'];
                $new_grp = "High Yield";

                if ($previous_yield < 75) {
                    $new_grp = "Low Yield";
                } else if ($previous_yield > 75 && $previous_yield < 110) {
                    $new_grp = "Moderate Yield";
                }

                $query = "update animal set day=0,calculation=0,grp='" . $new_grp . "' where id=" . $id;
                mysqli_query($con, $query);
            }

            // NOW ADD PRODUCTION DATA INTO YIELD...
            $query = "update animal set day=day+1,calculation=calculation+" . $milk . " where id=" . $id;
            mysqli_query($con, $query);

        }

    }

    private function just_update($con, $indexes)
    {
        $times = 2;
        $date = date("y-m-d");

        foreach ($indexes as $animal_id => $milk) {
            $sql = "update production set milk=" . $milk . "+milk , times=" . $times . " where animalid=" . $animal_id . " and date='" . $date . "'";

            mysqli_query($con, $sql);

            // now update the data into the pendingSales also...
            $this->sales->push_sales_db($con, $animal_id, $milk, $date);
            $this->Group_Recalculation($animal_id, $milk, $con);
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
        $added = false;

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
                $added = $this->just_update($con, $indexes);
            } else {

                // otherwise insert the new data for production...
                foreach ($indexes as $k => $v) {
                    // $sql = "update production set milk=" . $v . "*milk , times=" . $times . ", date='" . $date . "' where animalid= " . $k;
                    $sql = "insert into production (animalid,date,times,milk) values(" . $k . ",'" . $date . "'," . $times . "," . $v . ")";
                    $added = mysqli_query($con, $sql);

                    // now put this data into the pending sales section...
                    $this->sales->push_sales_db($con, $k, $v, $date);
                    $this->Group_Recalculation($k, $v, $con);

                }

            }

            mysqli_close($con);

        }

        return $added;
    }

    public function get_production_history($interval)
    {
        $con = $this->db->make_connection();
        $history = [];
        $index = 0;

        if ($con) {
            if ($interval == "days") {
                $sql = 'select sum(milk) as mmilk, date from production where  DATE(date)>=DATE(NOW())-INTERVAL 30 DAY group by Date';
            } else if ($interval == "months") {
                $sql = "SELECT DATE_FORMAT(DATE,'%M') AS date, SUM(MILK)as mmilk from production GROUP BY MONTH(DATE)";
            }else{
                return $history;
            }
            $result = mysqli_query($con, $sql);

            $xx = mysqli_num_rows($result);

            if ($xx > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $history[$index++] = [
                        "date" => $row["date"],
                        "milk" => $row["mmilk"]
                    ];
                }
            }
        }

        return $history;
    }
}
?>

