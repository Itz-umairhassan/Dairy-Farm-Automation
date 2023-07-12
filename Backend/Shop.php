<?php
require_once("./Backend/DBConnection.php");

class Shop{
    private $db;

    public function __construct()  {
        $this->db=new DataBase();
    }

    public function Get_All_products(){
       $con= $this->db->make_connection();

       $products=[];
       $index=0;

       if($con){
        $query="select * from products";

        $result=mysqli_query($con,$query);

        $xx=mysqli_num_rows($result);

        if($xx>0){
            while($row=mysqli_fetch_assoc($result)){
                $products[$index++]=$row;
            }
        }
        mysqli_close($con);
       }
       return $products;
    }

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

// ADD A NEW PRODUCT TO THE DATABASE....
public function add_Product($name, $price, $description, $quantity)
{
    $conn = $this->db->make_connection();

    if ($conn) {
        $sql = "INSERT INTO products (productname, price, description, quantity) VALUES ('" . $name . "', '" . $price . "', '" . $description . "', '" . $quantity . "')";

       // echo $sql;
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
                //echo "Product deleted successfully";
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

public function delete_Order($orderid){
    $con = $this->db->make_connection();
 
 
         if ($con) {
             
             // $sql = "SELECT * FROM products WHERE productid=".$productid;
             // $result = mysqli_query($con, $sql);
        $sql = "DELETE FROM `order` WHERE id =".$orderid;
         $result = mysqli_query($con, $sql);
 
         if ($result) {
             $rowsAffected = mysqli_affected_rows($con);
             mysqli_close($con);
 
             if ($rowsAffected > 0) {
                // echo "order deleted successfully";
                 return true;
             } else {
                 echo "order not found";
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
public function Get_All_Orders(){
    $con= $this->db->make_connection();

    $orders=[];
    $index=0;

    if($con){
        $query="select * from `order`";

     $result=mysqli_query($con,$query);

     $xx=mysqli_num_rows($result);

     if($xx>0){
         while($row=mysqli_fetch_assoc($result)){
             $orders[$index++]=$row;
         }
     }
     mysqli_close($con);
    }
    return $orders;
 }

 public function updateProductQuantity($orderId)
 {
     $conn = $this->db->make_connection();
 
     if ($conn) {
         // Fetch the order details
         $orderQuery = "SELECT productname, quantity FROM `order` WHERE id = $orderId";
        // echo $orderQuery;
         $orderResult = mysqli_query($conn, $orderQuery);
 
         if ($orderResult && mysqli_num_rows($orderResult) > 0) {
             $orderRow = mysqli_fetch_assoc($orderResult);
             $productName = $orderRow['productname'];
             $orderQuantity = $orderRow['quantity'];
            //echo"name\t". $productName."\torder quantity".$orderQuantity;
             // Find the corresponding product in the product table
             $productQuery = "SELECT quantity FROM products WHERE productname = '$productName'";
           //  echo $productQuery;

             $productResult = mysqli_query($conn, $productQuery);
 
             if ($productResult && mysqli_num_rows($productResult) > 0) {
                 $productRow = mysqli_fetch_assoc($productResult);
                 $productQuantity = $productRow['quantity'];
                //  echo "productquantity\t".$productQuantity;
 
                 // Calculate the new quantity
                 $newQuantity = $productQuantity - $orderQuantity;
               //  echo"new".$newQuantity;
 
                 // Update the product table with the new quantity
                 $updateQuery = "UPDATE products SET quantity = $newQuantity WHERE productname = '$productName'";
               //  echo"update query \t".$updateQuery;
                 $updateResult = mysqli_query($conn, $updateQuery);
 
                 if ($updateResult) {
                     mysqli_close($conn);
                    // echo"updated successfully";
                     return true; 
                     // Quantity updated successfully
                 }
             }
         }
     }
     echo"failed to update";
     return false; // Failed to update quantity
 }
 

}
