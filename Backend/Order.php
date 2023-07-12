<?php
require_once("./Backend/DBConnection.php");

class Order{
    private $db;

    public function __construct()  {
        $this->db=new DataBase();
    }

    public function Get_All_orders(){
       $con= $this->db->make_connection();

       $orders=[];
       $index=0;

       if($con){
        $query="select * from `order`";

        $result=mysqli_query($con,$query);

        $xx=mysqli_num_rows($result);

        if($xx>0){
            while($row=mysqli_fetch_assoc($result)){
                $products[$index++]=$row;
            }
        }
        mysqli_close($con);
       }
       return $orders;
    }

// ADD A NEW PRODUCT TO THE DATABASE....
// public function add_Order($name,$productname, $adress, $quantity,$contact,$userid)
// {
//     $conn = $this->db->make_connection();

//     if ($conn) {
//         $sql = "insert into order values(null,'" . $name . "'," . $productname . ',\'' . $description. '\',' . $quantity. ')' ;

//        // echo $sql;
//         if (mysqli_query($conn, $sql)) {
//             // $last_id = mysqli_insert_id($conn);

//             // $sql = "insert into production (animalid) values(" . $last_id . ")";
//             // mysqli_query($conn, $sql);
//             mysqli_close($conn);
//             return true;
//         } else {
//             return false;
//         }

//     }

//     return false;
// }

public function add_Order($username, $productName, $quantity, $address, $contact, $userID) {
    $con = $this->db->make_connection();

    if ($con) {
        $query = "INSERT INTO `order` (username, productname, quantity, adress, contact, userid) VALUES ('$username', '$productName', '$quantity', '$address', '$contact', '$userID')";
         echo $query;
        $result = mysqli_query($con, $query);

        if ($result) {
            mysqli_close($con);
            return true; // Order added successfully
        } else {
            mysqli_close($con);
            return false; // Failed to add order
        }
    } else {
        return false; // Failed to connect to the database
    }
}


public function update_Product($productId, $name, $price, $description, $quantity)
{
    $conn = $this->db->make_connection();

  
    if ($conn) {
        $sql = "UPDATE products SET productname=?, price=?, description=?, quantity=? WHERE productid=?";
        echo"$sql";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sdsdi", $name, $price, $description, $quantity, $productId);
        echo"$quantity";

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            return true;
        } else {
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            return false;
        }
    }

    return false;
}

// public function delete_Product($productid)
// {
//     $conn = $this->db->make_connection();

//     if ($conn) {
//         $sql = "DELETE FROM products WHERE productid = ?";

//         $stmt = mysqli_prepare($conn, $sql);
//         mysqli_stmt_bind_param($stmt, "i", $productid);

//         if (mysqli_stmt_execute($stmt)) {
//             mysqli_stmt_close($stmt);
//             echo "done";
//             mysqli_close($conn);
//             return true;

//         } else {
//             mysqli_stmt_close($stmt);
//             mysqli_close($conn);
//             return false;
//         }
//     }

//     return false;
// }

public function delete_Product($productid){
   $con = $this->db->make_connection();


        if ($con) {
            
            // $sql = "SELECT * FROM products WHERE productid=".$productid;
            // $result = mysqli_query($con, $sql);
       $sql = "DELETE FROM products WHERE productid =".$productid;
        $result = mysqli_query($con, $sql);

        if ($result) {
            $rowsAffected = mysqli_affected_rows($con);
            mysqli_close($con);

            if ($rowsAffected > 0) {
                echo "Product deleted successfully";
                return true;
            } else {
                echo "Product not found";
                return false;
            }
        } else {
            echo "Error executing query: " . mysqli_error($con);
            mysqli_close($con);
            return false;
        }
    }

    return false;
}







public function get_one_product_detail($productid)
{
    $con = $this->db->make_connection();

    try{
        if ($con) {
            
            $sql = "SELECT * FROM products WHERE productid=".$productid;
            $result = mysqli_query($con, $sql);
    
            if (!$result || mysqli_num_rows($result) == 0) {
                mysqli_close($con);
                return false;
            }
    
            $xx = mysqli_fetch_assoc($result);
    
            $rss = array(
                "productid" => $productid,
                "price" => $xx["price"],
                "description" => $xx["description"],
                "quantity" => $xx["quantity"],
                "name" => $xx["productname"]
            );
    
            mysqli_close($con);
            return $rss;
        } else {
            return false;
        }  
    }
    catch(Exception $e){
        echo $e;
    }
   
}

public function search_Product($productname) {
    $con = $this->db->make_connection();

    try {
        if ($con) {
            // Sanitize the input to prevent SQL injection
            $productname = mysqli_real_escape_string($con, $productname);
            
            // Modify the SQL query to perform a case-insensitive search
            $sql = "SELECT * FROM products WHERE LOWER(productname) = LOWER('$productname')";
           // echo $sql;
            $result = mysqli_query($con, $sql);
    
            if (!$result || mysqli_num_rows($result) == 0) {
                mysqli_close($con);
                return false;
            }
    
            $xx = mysqli_fetch_assoc($result);
    
            $rss = array(
                "productid" => $xx["productid"],
                "price" => $xx["price"],
                "description" => $xx["description"],
                "quantity" => $xx["quantity"],
                "name" => $xx["productname"]
            );
    
            mysqli_close($con);
            //print_r($rss);
            return $rss;
        } else {
            return false;
        }
    } catch (Exception $e) {
        echo $e;
    }
}


}
