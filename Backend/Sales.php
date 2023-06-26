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
    public function Insert_Sales($production_details, $price)
    {
        $con = $this->db->make_connection();

        $date = date('y-m-d');
        $kk=false;
        if ($con) {
            foreach ($production_details as $aniaml_id => $milk) {
                $sale = ((int) $milk) * $price;
                $sql = "insert into AnimalSale (animalid,date,sale) values(" . $aniaml_id . ",'" . $date . "'," . $sale . ")";
              if(mysqli_query($con,$sql)){
                $kk=true;
              }
            }

            mysqli_close($con);
            return $kk;
        } else {
            return false;
        }
    }
}

?>

