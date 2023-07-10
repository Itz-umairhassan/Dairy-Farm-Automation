<div class="dash-content">
    <?php
    include "./Front/alert.php";
    ?>
    <div class="title">
        <span class='text'>Create Diet Plan</span>
        <h5 class="foooo" id="msg1" style="color:green; margin-left:10px;"></h5>
        <h5 class="foooo" id="msg2" style="color:green; margin-left:10px;"></h5>
    </div>

    <form class="light">

        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label"> Plan Information: </label>
            <div class="col-sm-8">
                <input id="information" type="email" value='<?php echo $plan_info; ?> ' class="search_input feedinputs "
                    placeholder="Enter some information related to plan">
            </div>
        </div>

        <?php
        foreach ($plan as $feed => $quant) {
            echo '<div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">' . $feed . ' </label>
            <div class="col-sm-8">
                <input id=' . $feed . ' type="number" class="search_input feedinputs ' . $feed . '" value=' . $quant . ' placeholder="Enter Quantity of feed">
            </div>
        </div>';
        }
        ?>

        <div class="form-group row">
            <div class="col-sm-11">
                <div class="text-right">
                    <button type="submit" id="submit" class="btn  btn-primary pull-right custom_btn">Add Plan</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>

    function request_and_get_plan(event) {
        event.preventDefault();
        let spinner_html = `  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Adding Plan...`;

        let e = $("#submit")[0];
        $(e).html(spinner_html);

        // we will send data to backend in json format...
        let plan_obj = {};
        let key, val;

        document.querySelectorAll(".feedinputs").forEach(i => {
            key = i.classList[2];
            val = i.value;
            plan_obj[key] = val;
        })

        let formdata = new FormData();
        formdata.append('plan_details', JSON.stringify(plan_obj));
        formdata.append("information", $("#information").val());
        let id =<?php echo isset($parsed['id']) ? $parsed['id'] : -1 ?>;
        console.log(id);
        formdata.append("id", id)

        $.ajax({
            url: "./add/insert",
            contentType: false,
            processData: false,
            data: formdata,
            method: "POST",
            success: (message) => {
                message = JSON.parse(message);
                $("#alert_status").text("Success !");
                $("#alert_message").text("Plan section is updated now");
                $(".alert").toggle();

                setTimeout(() => {
                    $(".alert").toggle();
                }, 1000 * 2);

                $(e).html("Add Plan");
            },
            error: (err) => {
                $(e).html("Add Plan");
                $(".alert").toggle();
                $(".alert").removeClass("alert-success");
                $(".alert").addClass("alert-danger");
                $("#alert_status").text("Error !");
                $("#alert_message").text("Plan is Not Updated");

                setTimeout(() => {
                    $(".alert").toggle();
                    $(".alert").removeClass("alert-danger");
                    $(".alert").addClass("alert-success");
                }, 1000 * 2.5);
            }

        })
    }
    $(document).ready(() => {
        $("#submit").on("click", event => {
            request_and_get_plan(event);
        })

    })
</script>
