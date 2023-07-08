<div class="dash-content">
    <div class="title">
        <span class='text'>Create Diet Plan</span>
        <h5 class="foooo" id="msg1" style="color:green; margin-left:10px;"></h5>
        <h5 class="foooo" id="msg2" style="color:green; margin-left:10px;"></h5>
    </div>
    
    <form class="light">

        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label"> Plan Information: </label>
            <div class="col-sm-8">
                <input id="information" type="email" value='<?php echo $plan_info; ?> '
                class="search_input feedinputs " placeholder="Enter some information related to plan">
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
                <button type="submit" id="submit" class="btn  btn-primary pull-right custom_btn">Add</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>

    function request_and_get_plan(event) {
        event.preventDefault();
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
        let id=<?php echo isset($parsed['id']) ? $parsed['id'] : -1 ?>;
        console.log(id);
        formdata.append("id", id)

        $.ajax({
            url: "./add/insert",
            contentType: false,
            processData: false,
            data: formdata,
            method: "POST",
            success: (message) => {
                message=JSON.parse(message);
                console.log(message);
            },
            error: (err) => {
                console.log(err);
            }

        })
    }
    $(document).ready(() => {
        $("#submit").on("click", event => {
            request_and_get_plan(event);
        })

    })
</script>
