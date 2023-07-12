<div class="dash-content">
    <?php
    include './Front/alert.php';
    ?>

    <div class="title">
        <span class='text'>Add New Feed:</span>
        <h5 class="foooo" id="msg1" style="color:green; margin-left:10px;"></h5>
        <h5 class="foooo" id="msg2" style="color:green; margin-left:10px;"></h5>
    </div>
    <form id="myform" class="light">
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
                <button type="submit" id="submit" class="btn btn-primary">Add Feed</button>
            </div>
        </div>
    </form>
</div>

<script>
    $("#submit").on('click', event => {
        event.preventDefault();
        let spinner_html = `  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Adding Feed...`;

        let e = $("#submit")[0];
        console.log(e);
        $(e).html(spinner_html);

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
                message = JSON.parse(message)['message'];
                console.log(message);
                $("#alert_status").text("Success !");
                $("#alert_message").text(message[0] + " and " + message[1]);
                $(".alert").toggle();

                setTimeout(() => {
                    $(".alert").toggle();
                }, 1000 * 2);

                $(e).html("Add Feed");
                $("#myform")[0].reset();
            },
            error: (error) => {
                $(e).html("Add Feed");

                $(".alert").toggle();
                $(".alert").removeClass("alert-success");
                $(".alert").addClass("alert-danger");
                $("#alert_status").text("Error !");
                $("#alert_message").text("Feed is Not added");

                setTimeout(() => {
                    $(".alert").toggle();
                    $(".alert").removeClass("alert-danger");
                    $(".alert").addClass("alert-success");
                }, 1000 * 2.5);
            }
        })



    })
</script>
