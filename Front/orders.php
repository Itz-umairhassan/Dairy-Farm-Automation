<?php

require_once('./Backend/Helpers.php');
$help = new Helper();
$str = $_SERVER['QUERY_STRING'];

//echo $str;
$str = $help->parser($str);

?>

<div class="dash-content">
    <div class="title heading">
        <span class="text">Orders</span>

        <div id="table_spinner" class="spinner-border text-danger" style="display:none;" role="status">
            <span class="sr-only">Loading...</span>
        </div>

        <div class="d-flex">

        </div>
    </div>




    <!-- title -->
    <div class="table-responsive">
        <table class="table mb-0 align-middle text-nowrap lightcard cl-text">
            <thead>
                <tr>
                    <th class="border-top-0">User ID</th>
                    <th class="border-top-0">Product Name</th>
                    <th class="border-top-0">User Name</th>
                    <th class="border-top-0">Product Quantity</th>
                    <th class="border-top-0">Address</th>
                    <th class="border-top-0">Contact No</th>
                </tr>
            </thead>
            <tbody id="table_body">



            </tbody>
        </table>
    </div>

</div>

<script>
function make_request() {
  $("#table_spinner").toggle();

  $.ajax({
    url: "orders/get",
    method: "GET",
    success: function(response) {
      var result = JSON.parse(response).message;
      console.log(result);

      var html_data = '';

      $.each(result, function(index, item) {
        console.log("Printing: " + item.userid + " Product Name: " + item.productname);
        html_data += `
          <tr>
            <td>
              <div class="d-flex align-items-center">
                <div class="">
                  <h6 class="m-b-0 font-16">${item.userid}</h6>
                </div>
              </div>
            </td>
            <td>
              <h6 class="m-b-0 font-16">${item.productname}</h6>
            </td>
            <td>
              <h6 class="m-b-0 font-16">${item.username}</h6>
            </td>

            <td>
              <h6 class="m-b-0 font-16">${item.quantity}</h6>
            </td>
            <td>
              <h5 class="m-b-0 font-16">${item.adress}</h5>
            </td>
            <td>${item.contact}</td>
          
            <td id=${item.id}>
                    <a href="#" onclick="acceptOrder(${item.id})"><h5 class="m-b-0">Accept</h5></a>
            </td>

            <td id=${item.id}>
                    <a href="#" onclick="deleteOrder(${item.id})"><h5 class="m-b-0">Reject</h5></a>
            </td>
          </tr>`;
      });

      $("#table_body").html(html_data);
      $("#table_spinner").toggle();
    },
    error: function(error) {
      console.log(error);
      $("#table_spinner").toggle();
    }
  });
}


    function temporary_spinner() {
        let spinner = `<tr>
                <td>
                <div class="text-center">
                    <div class="spinner-border text-danger" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                </td>
                
            </tr>`;
        $("#table_body").html(spinner);
    }

    function deleteOrder(id) {
  if (confirm("Are you sure you want to reject this order?")) {
    $.ajax({
      url: "./order/decline?id=" + id,
      method: "GET",
      success: (data) => {
        let response = JSON.parse(data);
        console.log("response is"+response);
        make_request();
        if (response.message === "Ok")
         {

          // Successful deletion
          alert("Order rejected successfully");
      
          // Refresh the product list
          
        } else {
          // Error during deletion
          alert("Failed to reject Order");
        }
      },
      error: (error) => {
        console.log(error);
        alert("An error occurred during the deletion");
      }
    });
  }
}

function deliverOrder(id) {
  //if (confirm("Are you sure you want to deliver this order?")) {
    $.ajax({
      url: "./order/decline?id=" + id,
      method: "GET",
      success: (data) => {
        let response = JSON.parse(data);
        console.log("response is"+response);
        make_request();
        if (response.message === "Ok")
         {

          // Successful deletion
          alert("Order delivered now");
      
          // Refresh the product list
          
        } else {
          // Error during deletion
          alert("Failed to reject Order");
        }
      },
      error: (error) => {
        console.log(error);
        alert("An error occurred during the deletion");
      }
    });
  
}

function acceptOrder(id) {
  if (confirm("Are you sure you want to accept this order?")) {
    $.ajax({
      url: "./order/accept?id=" + id,
      method: "GET",
      success: (data) => {
        let response = JSON.parse(data);
        console.log("response is"+response);
        make_request();
        if (response.message === "Ok")
         {

          // Successful deletion
         // alert("Order delivered successfully");
          deliverOrder(id);
            
          // Refresh the product list
          
        } else {
          // Error during deletion
          alert("Failed to accepted Order");
        }
      },
      error: (error) => {
        console.log(error);
        alert("An error occurred during the accepting order");
      }
    });
  }
}





    $(document).ready(() => {

        make_request();

    })
</script>
