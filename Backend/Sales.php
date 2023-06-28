<?php
require_once('./Backend/DBConnection.php');

class Sales
{
    private $db;

    public function __construct()
    {
        $this->db = new DataBase();
    }

    // insert the new sales data into the database...get production details when it is sold
    // and add it into the database...
    public function Insert_Sales($production_details, $price, $agent_name)
    {
        $con = $this->db->make_connection();

        $date = date('y-m-d');

        if ($con) {
            foreach ($production_details as $object) {
                $sale = ((int) $object['quantity']) * $price;

                $sql = "insert into animalSale (animalID,date,sale,agent,earning,quantity,status)
                        values(" . $object['animalID'] .
                    ",'" . $object['date'] . "'," . $sale . ",'" . $agent_name . "',"
                    . $sale . "," . $object['quantity'] . ",'sold')";

                // echo $sql . "\n";
                mysqli_query($con, $sql);

                // now delete this data from the pending sales...
                $sql = "delete from pendingsales where date='" . $object['date'] . "' and animalID=" . $object['animalID'];

                mysqli_query($con, $sql);

            }

            mysqli_close($con);
        } else {
            return false;
        }

        return true;

    }


    // make calculations and set this data of pending Sales into array...
    public function calculate_pending_sales()
    {
        $con = $this->db->make_connection();

        $sales_arr = [];
        $ii = 0;
        if ($con) {
            $sql = "select date,sum(quantity) as sum from pendingsales group by date";
            $result = mysqli_query($con, $sql);

            $xx = mysqli_num_rows($result);
            if ($xx > 0) {
                while ($data = mysqli_fetch_assoc($result)) {
                    $sales_arr[$ii] = [$data['date'], $data['sum']];
                    $ii++;
                }
            }

            mysqli_close($con);
        }

        return $sales_arr;
    }

    // so first of all fetch all realted details for pending sale of current date..above function
    // just return sum but this one return all details...
    public function get_details_of_pending($date)
    {
        $con = $this->db->make_connection();
        $details = [];
        $index = 0;

        if ($con) {
            $sql = "select * from pendingsales where date='" . $date . "'";

            $result = mysqli_query($con, $sql);
            $xx = mysqli_num_rows($result);

            if ($xx > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $details[$index] = [
                        "date" => $row['date'],
                        "animalID" => $row['animalID'],
                        "quantity" => $row['Quantity']
                    ];

                    $index++;
                }
            }

            mysqli_close($con);
        }

        return $details;
    }
}

?>

