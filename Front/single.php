<?php

require_once('./Backend/Helpers.php');
$help = new Helper();
$str = $_SERVER['QUERY_STRING'];

echo $str;
$str = $help->parser($str);

?>

<div class="dash-content">
    <div class="title heading">
        <span class="text">Shop</span>

        <div id="table_spinner" class="spinner-border text-danger" style="display:none;" role="status">
            <span class="sr-only">Loading...</span>
        </div>

        <div class="d-flex">
    <input type="text" id="searchname"class="form-control me-2" placeholder="Search Product" style="width: 200px;">
    <button id="search" type="button" class="btn btn-primary mx-2">Search Product</button>
    <a href="./addproduct"> <button type="button" class="btn btn-primary mx-2">Add New Product</button></a>
</div>
    </div>

    


    <!-- title -->
    <div class="table-responsive">
        <table class="table mb-0 table-hover align-middle text-nowrap lightcard cl-text">
            <thead>
                <tr>
                    <th class="border-top-0">Product ID</th>
                    <th class="border-top-0">Product Name</th>
                    <th class="border-top-0">Product Price</th>
                    <th class="border-top-0">Product Quantity</th>
                    <th class="border-top-0">Product Description</th>
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
            url: `./shop/get`,
            method: "GET",
            contentType: false,
            processData: false,
            success: (data) => {
                let result = JSON.parse(data)['message'];
                let html_data = ``;

                console.log(result);

                result.forEach(obj => {
                    html_data += `  <tr>
                    <td>
                        <div class="d-flex align-items-center">

                            <div class="">
                                <h6 class="m-b-0 font-16">${obj['productid']}</h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <h6 class="m-b-0 font-16">${obj['productname']}</h6>
                    </td>
                    <td>
                        <h6 class="m-b-0 font-16">${obj['price']}</h6>
                    </td>
                    <td>
                     <h5 class="m-b-0 font-16"> ${obj['quantity']} </h5> 
                    </td>
                    <td>${obj['description']}</td>
                    
                    <td id=${obj.productid}>
                      <a href=${`./product/edit?id=` + obj.productid}  <h5 class="m-b-0">Edit</h5>
                    </td>

                    <td id=${obj.productid}>
                      <a href=${`./product/delete?id=` + obj.productid}  <h5 class="m-b-0">Delete</h5>
                    </td>
                    
                </tr>`;
                });

                // now set it into the table body;
                $("#table_body").html(html_data);
                $("#table_spinner").toggle();
            },
            error: (error) => {
                console.log(error);
                $("#table_spinner").toggle();
            }
        })
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

    
$("#search").on('click', event => {

        
event.preventDefault();

let name = $("#searchname").val();
let data = new FormData();

data.append("productname", name);

for (const pair of data.entries()) {
console.log(pair[0] + ': ' + pair[1]);
}

console.log(name);
if(name !== "")
{
$.ajax({
    url: './search',
    data: data,
    method: "POST",
    contentType: false,
    processData: false,
    success: (message) => {
        $("#msg").text(" sucessfully");
        setTimeout(() => {
            $("#msg").text("");
        }, 1000 * 2);

      //  $("form").clear();
    },
    error: (error) => {
        console.log(error);
    }
})
console.log("name not empty"+name);
}
else
{
    console.log("empty name")
}
})




    $(document).ready(() => {

        make_request();

    })
</script>
