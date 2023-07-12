<?php
require_once('./Backend/DBConnection.php');

class Sales
{
    private $db;

    public function __construct()
    {
        $this->db = new DataBase();
    }

    public function push_sales_db($con, $animal_id, $quantity, $date)
    {
        $sql = "select * from pendingsales where date='" . $date . "' and animalID=" . $animal_id . " limit 1";
        $result = mysqli_query($con, $sql);
        $xx = mysqli_num_rows($result);

        // now either insert or update( if data already exists ... $xx > 0 )

        if ($xx > 0) {
            $sql = "update pendingsales set Quantity=" . $quantity . "+Quantity where animalID=" . $animal_id . " and date='" . $date . "'";
            mysqli_query($con, $sql);
        } else {
            $sql = "insert into pendingsales (date,animalID,Quantity) values('" . $date . "'," . $animal_id . "," . $quantity . ")";
            mysqli_query($con, $sql);
        }
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


    // now get the total sales from animal sales database....
    public function get_total_Sales()
    {
        $con = $this->db->make_connection();
        $sales_data = [];


        if ($con) {
            $sql = "select * from animalsale";
            $result = mysqli_query($con, $sql);

            $xx = mysqli_num_rows($result);
            $index = 0;

            if ($xx > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $date = $row['date'];

                    if (isset($sales_data[$date])) {
                       // $sales_data[$date]["agent"] .= ("," . $row["agent"]);
                        $sales_data[$date]["sale"] = $sales_data[$date]["sale"] + $row["sale"];
                        $sales_data[$date]["earning"] += $row["earning"];
                        $sales_data[$date]["quantity"] += $row["quantity"];

                    } else {
                        $sales_data[$date] = [
                            "date" => $row["date"],
                            "agent" => $row["agent"],
                            "sale" => $row['sale'],
                            "earning" => $row["earning"],
                            "status" => "sold",
                            "quantity" => $row["quantity"]
                        ];
                        $index++;
                    }

                }
            }

            mysqli_close($con);
        }

        return $sales_data;
    }
}

?>

