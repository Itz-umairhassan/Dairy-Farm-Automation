<?php

require_once('./Backend/Helpers.php');
$help = new Helper();
$str = $_SERVER['QUERY_STRING'];

echo $str;
$str = $help->parser($str);

?>

<div class="dash-content">
    <div class="title heading">
        <span class="text">Diet Plans:</span>

        <div id="table_spinner" class="spinner-border text-danger" style="display:none;" role="status">
            <span class="sr-only">Loading...</span>
        </div>

        <div>
            <a href="./plan/add"> <button type="button" class="btn btn-primary">Add New Plan</button></a>

        </div>

    </div>



    <!-- title -->
    <div class="table-responsive">
        <table class="table mb-0 table-hover align-middle text-nowrap lightcard cl-text">
            <thead>
                <tr>
                    <th class="border-top-0">Plan ID</th>
                    <th class="border-top-0">Plan Information</th>
                    <th class="border-top-0">Assigned Animals</th>
                    <th class="border-top-0">See Details</th>
                </tr>
            </thead>
            <tbody id="table_body">

            </tbody>
        </table>
    </div>

</div>

<script>

    function make_request() {
        console.log("Sending request");
        $("#table_spinner").toggle();


        $.ajax({
            url: `./plan/get`,
            method: "GET",
            contentType: false,
            processData: false,
            success: (data) => {
                let result = JSON.parse(data);
                console.log(result['message']);
                result=result['all_plans'];
                let html_data = ``;

                result.forEach(obj => {
                    html_data += `  <tr>
                    <td>
                        <div class="d-flex align-items-center">

                            <div class="">
                                <h6 class="m-b-0 font-16">${obj['id']}</h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <h6 class="m-b-0 font-16">${obj['planinformation']}</h6>
                    </td>
                    <td>
                        <h6 class="m-b-0 font-16">${obj['animals']}</h6>
                    </td>
                    <td id=${obj.ID}>
                      <a href=${`./plan/details?id=` + obj.ID}  <h5 class="m-b-0">See Details</h5>
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
    $(document).ready(() => {
        make_request();
    })
</script>
