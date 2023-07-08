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

        $query = "update feed set quantity=quantity+" . $quantity . ",price=price+" . $spending . " where name='" . $name."'";
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
}

?>

