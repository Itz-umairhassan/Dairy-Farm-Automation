<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Form</title>
    <script src="../JS Scripts//jq.js"></script>
  
    <style>
        body {
            background-color: #f2f2f2;
        }

        .form-container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 6px;
            background-color: rgba(255, 255, 255, 0.8);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
        }

        .form-heading {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            text-align: center;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 10px 0;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .product-options {
            margin-bottom: 20px;
        }

        .product-options label {
            /* display: block; */
            margin-bottom: 10px;
        }
    </style>
</head>

<body style="background-image:url(banner2.png);">
    <?php
    $error_message;
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION['type'])) {
        // echo "here";
        if ($_SESSION['type'] === 'user') {
            echo "user";
            echo "id" . $_SESSION['userid'];
            // header("Location: ./userhome");
        } elseif ($_SESSION['type'] === 'admin') {
            // header("Location: ./home");
        }
    } ?>
    <div class="form-container">
        <h2 class="form-heading">Enter Details</h2>
        <form id="orderForm">
            <div class="form-group">
                <p style="display: none;">id is <span id="userid"> <?php echo $_SESSION['userid'];   ?></span></p>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="product-options">
                <label for="product">Select a product:</label><br>
                <input type="radio" id="milk-A" name="product" value="milk" required>
                <label for="milk">Milk</label>
                <input type="radio" id="yogurt-A" name="product" value="yogurt">
                <label for="yogurt">Yogurt</label>
                <input type="radio" id="butter-A" name="product" value="butter">
                <label for="butter">Butter</label><br>
                <input type="radio" id="cheese-A" name="product" value="cheese">
                <label for="cheese">Cheese</label>
                <input type="radio" id="cream-A" name="product" value="cream">
                <label for="cream">Cream</label>
                <br>
                <p>enter quantity between 5 and <span id="max"></span></p>
                <div class="form-group">
                    <label for="quantity">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" required>
                </div>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea id="address" name="address" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="contact">Contact:</label>
                <input type="text" id="contact" name="contact" required>
            </div>
            <div class="form-group">
                <button id='send' type="submit" class="btn">Submit</button>
            </div>
            <div id="errorContainer"></div>
        </form>
    </div>

    <script>
      
      
        $(document).ready(()=> {
            console.log("Docuemnt is ready");
            var spanText = $('#userid').text();
            console.log('Span Text:', spanText);
            let radioButtonID;
            $('input[name="product"]').on('click', function() {
                console.log("clicked product");
                radioButtonID = $(this).attr('id');
                console.log('Selected radio button ID:', radioButtonID);
                let data = new FormData();

                data.append("productname", radioButtonID);

                for (const pair of data.entries()) {
                    console.log("entry" + pair[0] + ': ' + pair[1]);
                }

                console.log(radioButtonID);
                if (radioButtonID !== "") {
                    $.ajax({
                        url: '/Dairy-Farm-Automationfinal/getquantity',
                        data: data,
                        method: "POST",
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            //$("#msg").text(" sucessfully");
                            console.log('agya')
                            let fetched_data = JSON.parse(data);
                            console.log(fetched_data);
                            // var maxQuantity = response.maxQuantity; 
                            // console.log(maxQuantity);
                            // console.log("response"+response);
                            // console.log("response"+data.productid);
                            console.log(fetched_data.productid)
                            console.log(fetched_data.quantity)

                            //var userid= "<?php echo isset($_SESSION['userid']) ? $_SESSION['userid'] : ''; ?>";

                            // Use the userID variable in your JavaScript code as needed
                            console.log('User ID:', userid);
                            $('#quantity').attr('min', 10).attr('max', fetched_data.quantity);
                            $('#max').text(fetched_data.quantity);
                            setTimeout(() => {
                                $("#msg").text("");
                            }, 1000 * 2);


                            //  $("form").clear();
                        },
                        error: (error) => {
                            console.log(error);
                        }
                    })
                    console.log("name not empty" + name);
                } else {
                    console.log("empty name")
                }

            })

            console.log('Selected radio button ID: outsode   ', radioButtonID);

            <?php echo $_SESSION['userid'] ?>

            $("#send").on('click', event => {

               console.log("clicked send")
                event.preventDefault();

                var name = $('#name').val();
                var product = $('input[name="product"]:checked').val();
                var quantity = $('#quantity').val();
                var address = $('#address').val();
                var contact = $('#contact').val();


                console.log('Name:', name);
                console.log('Product:', product);
                console.log('Quantity:', quantity);
                console.log('Address:', address);
                console.log('Contact:', contact);
                var max=parseInt($('#max').text())
                console.log("original value\t"+$('#max').text());
                console.log("parsed value\t"+max);

                if( parseInt(quantity)>max||parseInt(quantity)<5 )
                   {
                    $('#errorContainer').text('Please enter value in the given range').css('color', 'red');
                    return;
                   }
                   
                if (name === '' || product === undefined || quantity === '' || address === '' || contact === '') {
                    // Show error message
                    $('#errorContainer').text('Please fill in all the required fields.').css('color', 'red');
                
                } else {

                    let data = new FormData();

                    data.append("username", name);
                    data.append("productname", product);
                    data.append("quantity", quantity);
                    data.append("adress", address);
                    data.append("contact", contact);
                    data.append("userid", spanText)

                    for (const pair of data.entries()) {
                        console.log(pair[0] + ': ' + pair[1]);
                    }
                    if (name !== "") {
                    $.ajax({
                        url: '/Dairy-Farm-Automation5/addorder',
                        data: data,
                        method: "POST",
                        contentType: false,
                        processData: false,
                        success: (message) => {
                            console.log("Added sucessfully");
                              alert("order placed successfully");
                            setTimeout(() => {
                               // $("#msg").text("");
                            }, 1000 * 2);
                            $('#orderForm')[0].reset();
                            //  $("form").clear();
                        },
                        error: (error) => {
                            console.log(error);
                            console.log("inside error")
                        }
                    })
                    console.log("name not empty" + name);
                } else {
                    console.log("empty name")
                }

                }


            })

        });
    </script>
</body>

</html>
