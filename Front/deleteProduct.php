<?php
require_once("./Backend/Helpers.php");
$helper = new Helper();

$parsed = $helper->parser($_SERVER['QUERY_STRING']);
?>



<div class="dash-content">
    <div class="title">
        <span class="text">Delete Product:</span>
        <h5 class="foooo" id="msg" style="color:green; margin-left:10px;"></h5>
    </div>
    <form class="light">

        <div class="form-group row">
            <label for="id" class="col-sm-2 col-form-label">ID: </label>
            <div class="col-sm-8">
                <span id="id" class="data"><?php echo $parsed['id'] ?></span>
            </div>


        </div>

        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Name: </label>
            <div class="col-sm-8">
                <input id="name" type="text" class="search_input" placeholder=" Name">
            </div>
        </div>
        <div class="form-group row">
            <label for="price" class="col-sm-2 col-form-label">Price: </label>
            <div class="col-sm-8">
                <input id="price" type="text" class="search_input" placeholder=" price">
            </div>
        </div>

        <div class="form-group row">
            <label for="product-description" class="col-sm-2 col-form-label">Product Description:</label>
            <div class="col-sm-8">
                <input id="description" type="text" class="search_input" placeholder="description">
            </div>
        </div>

        <div class="form-group row">
            <label for="product-quantity" class="col-sm-2 col-form-label">Quantity:</label>
            <div class="col-sm-8">
                <input id="quantity" type="text" class="search_input" placeholder="Enter quantity">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                <button type="delete" id="delete" class="btn btn-primary">Edit</button>
            </div>
        </div>
    </form>
</div>
<script>
    function fetch_product_details() {
        let id = <?php echo $parsed['id']  ?>;
        let data = new FormData();
        data.append("productid", id);
        $.ajax({
            url: './get',
            type: 'post',
            data: data,
            contentType: false,
            processData: false,
            success: (data) => {

                console.log(data);
                let fetched_data = JSON.parse(data);
                console.log(fetched_data);

                $("#name").val(fetched_data.name);
                $("#price").val(fetched_data.price);
                $("#description").val(fetched_data.description);
                $("#quantity").val(fetched_data.quantity);





                // console.log(data)
                // let fetched_data = JSON.parse(data);
                // console.log(fetched_data);
                //  $("#name").val(fetched_data['productname']);

                //  $("#price").text(fetched_data['price']);
                //  $("#description").text(fetched_data['description']);
                //  $("#quantity").text(fetched_data['quantity']);

                //  $(".spinners").toggle();
            },
            error: (message) => {
                $(".spinners").toggle();
                console.log(message);
            }
        })
    }



    $(document).ready(() => {
        fetch_product_details();
    })


    let id = <?php echo $parsed['id']  ?>;
        let data = new FormData();
        

    $("#delete").on('click', event => {

        
        event.preventDefault();
        


        let data = new FormData();

   
        data.append("productid", id);
        for (const pair of data.entries()) {
        console.log(pair[0] + ': ' + pair[1]);
    }

 

        $.ajax({
            url: './delete',
            data: data,
            method: "POST",
            contentType: false,
            processData: false,
            success: (message) => {
                $("#msg").text("deleted sucessfully");
                setTimeout(() => {
                    $("#msg").text("");
                }, 1000 * 2);
            
                
               $("form").clear();
            },
            error: (error) => {
                console.log(error);
            }
        })

    })
</script> 