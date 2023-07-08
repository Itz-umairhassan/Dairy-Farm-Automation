<?php

require_once('./Backend/Helpers.php');
$help = new Helper();
$str = $_SERVER['QUERY_STRING'];

echo $str;
$str = $help->parser($str);

?>

<div class="dash-content">
    <div class="title heading">
        <span class="text">Animals</span>

        <div id="table_spinner" class="spinner-border text-danger" style="display:none;" role="status">
            <span class="sr-only">Loading...</span>
        </div>

        <div>
            <select class="drop light mx-3" name="" id="types">
                <?php
                // some php code to setup the filters on the bases of the query string....
                $options = ["All", "Healthy", "Unhealthy", "pregnant"];

                if (isset($str['type'])) {
                    echo '<option value="' . $str['type'] . '"> ' . $str['type'] . ' </option>';
                }
                for ($i = 0; $i < 4; $i++) {
                    if (strtolower($options[$i]) !== strtolower($str['type'])) {
                        echo '<option value="' . $options[$i] . '"> ' . $options[$i] . ' </option>';
                    }
                }
                ?>
            </select>
            <a href="./animal/add"> <button type="button" class="btn btn-primary">Add Animal</button></a>

        </div>

    </div>



    <!-- title -->
    <div class="table-responsive">
        <table class="table mb-0 table-hover align-middle text-nowrap lightcard cl-text">
            <thead>
                <tr>
                    <th class="border-top-0">Animal ID</th>
                    <th class="border-top-0">Breed</th>
                    <th class="border-top-0">Price (Pkr)</th>
                    <th class="border-top-0">Health Condition</th>
                    <th class="border-top-0">Group</th>
                    <th class="border-top-0">Diet Plan ID</th>
                    <th class="border-top-0">Details</th>
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
            url: `./animal/get_animals?type=${$("#types").val()}`,
            method: "GET",
            contentType: false,
            processData: false,
            success: (data) => {
                try {
                    let result = JSON.parse(data);
                    let html_data = ``;



                    result.forEach(obj => {
                        html_data += `  <tr>
                    <td>
                        <div class="d-flex align-items-center">

                            <div class="">
                                <h6 class="m-b-0 font-16">${obj.ID}</h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <h6 class="m-b-0 font-16">${obj['species']}</h6>
                    </td>
                    <td>
                        <h6 class="m-b-0 font-16">${obj['price']}</h6>
                    </td>
                    <td>
                        <label class="badge bg-${obj.healthy == 1 ? 'success' : 'danger'}">${obj.healthy == 1 ? "Healthy" : "Unhealthy"}</label>
                    </td>
                    <td>${obj.group}</td>
                    <td>${obj['dietplan']}</td>
                    
                    <td id=${obj.ID}>
                      <a href=${`./animal/details?id=` + obj.ID}  <h5 class="m-b-0">Details</h5>
                    </td>
                </tr>`;
                    });

                    // now set it into the table body;
                    $("#table_body").html(html_data);
                    $("#table_spinner").toggle();
                } catch (error) {
                    $("#table_spinner").toggle();
                }
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
    $(document).ready(() => {
        $("#types").change(() => {

            make_request();
        })

        make_request();

    })
</script>
