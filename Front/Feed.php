<div class="dash-content">
    <div class="title heading">
        <span class="text">Available Feed Items</span>

        <div id="table_spinner" class="spinner-border text-danger" style="display:none;" role="status">
            <span class="sr-only">Loading...</span>
        </div>

        <div>
            <a href="./feed/add"> <button type="button" class="btn btn-primary">Add New Feed</button></a>
        </div>

    </div>


    <!-- title -->
    <div class="table-responsive">
        <table class="table mb-0 table-hover align-middle text-nowrap lightcard cl-text">
            <thead>
                <tr>
                    <th class="border-top-0"> ID</th>
                    <th class="border-top-0">Name</th>
                    <th class="border-top-0">Price (Pkr)</th>
                    <th class="border-top-0">Available Quantity</th>
                    <th class="border-top-0">Status</th>
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
            url: `./feed/get`,
            method: "GET",
            contentType: false,
            processData: false,
            success: (data) => {
                let result=JSON.parse(data);
                console.log(result['message']);
                result = result['data'];
               
                let html_data = ``;

                console.log(result);
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
                        <h6 class="m-b-0 font-16">${obj['Name']}</h6>
                    </td>
                    <td>
                        <h6 class="m-b-0 font-16">${obj['Price']}</h6>
                    </td>
                    <td>
                        <h6 class="m-b-0 font-16">${obj['quantity']}</h6>
                    </td>
                    <td>
                        <label class="badge bg-${obj['quantity'] > 5 ? 'success' : 'danger'}">${obj['quantity'] >5  ? "Enough" : "Low"}</label>
                    </td>
                </tr>`;
                });

                // // now set it into the table body;
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
