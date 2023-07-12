




<div class="dash-content">
    <div class="title">
        <span class="text">Add Product:</span>
        <h5 class="foooo" id="msg" style="color:green; margin-left:10px;"></h5>
    </div>
    <form class="light">
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Name: </label>
            <div class="col-sm-8">
                <input id="name" type="text" class="search_input" placeholder="Enter Name">
            </div>
        </div>
        <div class="form-group row">
            <label for="price" class="col-sm-2 col-form-label">Price: </label>
            <div class="col-sm-8">
                <input id="price" type="text" class="search_input" placeholder="Enter Price">
            </div>
        </div>

        <div class="form-group row">
            <label for="product-description" class="col-sm-2 col-form-label">Product Description:</label>
            <div class="col-sm-8">
                <textarea id="product-description" name="product-description" class="search_input" rows="4" cols="50"></textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="product-quantity" class="col-sm-2 col-form-label">Quantity:</label>
            <div class="col-sm-8">
                <input type="number" id="product-quantity" name="product-quantity" min="1" value="1" class="search_input">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" id="submit" class="btn btn-primary">Add</button>
            </div>
        </div>
    </form>
</div>
<script>
    $("#submit").on('click', event => {
        event.preventDefault();

        let name = $("#name").val();
        let price= $("#price").val();
        let description = $('#product-description').val();
        let quantity = $("#product-quantity").val();
       

        let data = new FormData();
        data.append("name", name);
        data.append("price", price);
        data.append("description", description);
        data.append("quantity", quantity);
       

        $.ajax({
            url: './add/product',
            data: data,
            method: "POST",
            contentType: false,
            processData: false,
            success: (message) => {
                $("#msg").text("Added sucessfully");
                setTimeout(() => {
                    $("#msg").text("");
                }, 1000 * 2);

              //  $("form").clear();
            },
            error: (error) => {
                console.log(error);
            }
        })

    })
</script>
