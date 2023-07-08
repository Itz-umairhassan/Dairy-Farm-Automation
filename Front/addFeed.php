<div class="dash-content">
    <div class="title">
        <span class='text'>Add New Feed:</span>
        <h5 class="foooo" id="msg1" style="color:green; margin-left:10px;"></h5>
        <h5 class="foooo" id="msg2" style="color:green; margin-left:10px;"></h5>
    </div>
    <form class="light">
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Name: </label>
            <div class="col-sm-8">
                <input id="feedname" type="text" class="search_input" placeholder="Enter Name of feed">
            </div>
        </div>

        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Price: </label>
            <div class="col-sm-8">
                <input id="feedprice" type="number" class="search_input" placeholder="Enter price of feed">
            </div>
        </div>

        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Quantity: </label>
            <div class="col-sm-8">
                <input id="feedquantity" type="email" class="search_input" placeholder="Enter Quantity of feed">
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

        let data = new FormData();
        data.append("name", $("#feedname").val());
        data.append("price", $("#feedprice").val());
        data.append("quantity", $("#feedquantity").val());

        $.ajax({
            url: './add/insert',
            data: data,
            method: "POST",
            contentType: false,
            processData: false,
            success: (message) => {
                message=JSON.parse(message)['message'];
                console.log(message);
                $("#msg1").text(message[0]);
                $("#msg2").text(message[1]);
                setTimeout(() => {
                    $("#msg1").text("");
                    $("#msg2").text("");
                }, 1000 * 2);

                $("form").clear();
            },
            error: (error) => {
                console.log(error);
            }
        })

    })
</script>
