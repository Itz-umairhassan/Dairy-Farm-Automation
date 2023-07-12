<?php
require_once("./Backend/DBConnection.php");

class Feed
{
    private $db;

    public function __construct()
    {
        $this->db = new DataBase();
    }

    public function Update_Feed($name, $price, $quantity, $con)
    {
        $spending = $quantity * $price;

        $query = "update feed set quantity=quantity+" . $quantity . ",price=price+" . $spending . " where name='" . $name . "'";
        //echo $query."<br>";
        $result = mysqli_query($con, $query);

        return $result;

    }

    public function Insert_Feed($name, $price, $quantity)
    {
        $con = $this->db->make_connection();

        $added = [false, false];

        if ($con) {

            $query = "select * from feed where Name='" . $name . "'";
            $result = mysqli_query($con, $query);

            if (mysqli_num_rows($result) > 0) {
                $added[0] = $this->Update_Feed($name, $price, $quantity, $con);
            } else {

                $spending = $price * $quantity;
                $query = "insert into feed values( null , '" . $name . "'," . $spending . "," . $quantity . ")";


                $result = mysqli_query($con, $query);
                $added[0] = $result;
            }

            if ($added[0]) {

                // now update finance record as we did pay for this feed .. add into record.
                $spending = $price * $quantity;
                $query = "update finance set spendings=spendings+" . $spending . ",profit=profit-" . $spending;

                $result = mysqli_query($con, $query);

                if ($result) {
                    $added[1] = true;
                }

            }
            mysqli_close($con);
        }

        return $added;
    }

    public function Get_Feeds()
    {
        $con = $this->db->make_connection();
        $feeds = [];
        $index = 0;
        if ($con) {
            $query = "select * from feed";

            $result = mysqli_query($con, $query);

            $xx = mysqli_num_rows($result);
            if ($xx > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $feeds[$index++] = $row;
                }
            }
            mysqli_close($con);
        }

        return $feeds;
    }


    // create a new diet plan...
    public function Create_plan($plan_data, $id, $plan_information)
    {
        $con = $this->db->make_connection();
        $result = [400, "Not Added"];
        $first = true;

        if ($con) {

            if ($id != -1) {
                $query = "delete from dietplan where id=" . $id;
                mysqli_query($con, $query);
            }

            // first of all convert this array[key pair-based] into a string...

            $plan_details = "";
            foreach ($plan_data as $feed => $quantity) {
                if (!$first) {
                    $plan_details .= ",";
                }
                $plan_details .= ($feed . "=" . $quantity);

                $first = false;
            }

            $query = "";
            if ($id != -1) {
                $query = "insert into dietplan values(" . $id;
            } else {
                $query = "insert into dietplan values(null";
            }

            $query = $query . ",'" . $plan_details . "','" . $plan_information . "',0)";

            if (mysqli_query($con, $query)) {
                $result = [200, "Plan is added"];
            }
        }

        return $result;
    }

    // a fucntion to convert these diet plans into key-value array..
    public function convert_into_array($str)
    {
        $arr = explode(',', $str);

        $ans = [];

        foreach ($arr as $substr) {
            $subarray = explode('=', $substr);
            $ans[$subarray[0]] = $subarray[1];
        }

        return $ans;
    }

    public function Get_Plan_By_Id($id)
    {
        $con = $this->db->make_connection();
        $diet_plan = [];

        if ($con) {
            $query = "select * from dietplan where id=" . $id;
            $result = mysqli_query($con, $query);

            $xx = mysqli_num_rows($result);

            if ($xx > 0) {
                $row = mysqli_fetch_assoc($result);
                $diet_plan[0] = $row['planinformation'];
                $diet_plan[1] = $this->convert_into_array($row['feedDetails']);
            }

            mysqli_close($con);
        }

        return $diet_plan;
    }

    public function Get_Diet_Plans()
    {
        $con = $this->db->make_connection();

        $all_plans = [];
        $index = 0;
        if ($con) {
            $query = "select * from dietplan";

            $result = mysqli_query($con, $query);

            $xx = mysqli_num_rows($result);

            if ($xx > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $all_plans[$index++] = $row;
                }
            }

        }

        return $all_plans;
    }

    // SET NEW DIET PLAN FOR ANIMAL...
    public function Change_Plan($animal_id, $new_plan, $previous_plan)
    {
        $con = $this->db->make_connection();
        $ans = [400, "Changes are not updated"];
        if ($con) {
            $query = "update animal set DietPlan='" . $new_plan . "' where id=" . $animal_id;

            
            $rss = mysqli_query($con, $query);

            if ($rss) {
                $ans = [200, "Changes are Updated"];
            }

            $query = "update dietplan set animals=animals+1 where planinformation='" . $new_plan."'";
            //echo $query;
            mysqli_query($con, $query);
            $query = "update dietplan set animals=animals-1 where planinformation='" . $previous_plan."'";
            mysqli_query($con, $query);
            mysqli_close($con);
        }

        return $ans;
    }
}

?>

