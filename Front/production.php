<style>
    input[type="file"] {
        display: none;
    }

    .custom-file-upload {
        border: 1px solid #ccc;
        display: inline-block;
        padding: 6px 12px;
        cursor: pointer;
        font-size: 15px;
        cursor: pointer;

        transition: 0.7s all;
    }

    .custom-file-upload:hover {
        border-color: #d32f2f;

        background-color: #d32f2f;
    }
</style>

<div class="dash-content">

    <div class="title heading">
        <span class='text'>Production History</span>

        <div>
            <label for="myfile" class="custom-file-upload text2">
                Upload a JSON file
            </label>
            <input style=" width: 100px; cursor:pointer;" id="myfile" type="file" class="btn-primary" name="csv">
            <button id="upload" type="button" class="btn btn-primary">Enter new Production </button>

        </div>
    </div>

    <div class="row ">
        <!-- column -->
        <div class="col-12 ">
            <div class="card lightcard cl-text">
                <div class="card-body">
                    <!-- title -->
                    <div class="d-md-flex my-2">

                        <div class="ms-auto mx-4">
                            <div class="dl">
                                <select class="form-select shadow-none drop light">
                                    <option value="0" selected>Monthly</option>
                                    <option value="1">Daily</option>
                                    <option value="2">Weekly</option>
                                    <option value="3">Yearly</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- title -->
                    <div class="table-responsive">
                        <table class="table mb-0 align-middle text-nowrap lightcard cl-text">
                            <thead>
                                <tr>
                                    <th class="border-top-0">No.</th>
                                    <th class="border-top-0">Date</th>
                                    <th class="border-top-0">Quantity(liter)</th>
                                    <th class="border-top-0">Status</th>
                                    <th class="border-top-0">Agent</th>
                                    <th class="border-top-0">Profit</th>
                                    <th class="border-top-0">Earning</th>
                                </tr>
                            </thead>
                            <tbody id="tbd">

                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center">
                        <div id="pending_spin" class="spinner-border" role="status" style="display:none;">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

    let spinner_html = `  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
  Uploading...`;

    function handle_uploading(event) {
        event.preventDefault();

        $("#upload").html(spinner_html);
        let file_data = $("#myfile").prop('files')[0];
        let form_data = new FormData();
        form_data.append("csv", file_data);

        $.ajax({
            url: './production/add',
            dataType: "text",
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: (message) => {
                $("#upload").html("Enter new Production");
                console.log(JSON.parse(message));
            },
            error: (message) => {
                $("#upload").html("Enter new Production");
                console.log(message);
            }

        })
    }

    function table_filler(data) {
        let row_html = "";
        let idx = 1;

        for (let index in data) {
            row_html += `<tr>
                                    <td>
                                        <div class="d-flex align-items-center">

                                            <div class="">
                                                <h6 class="m-b-0 font-16">${idx++}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h6 class="m-b-0 font-16">${data[index]['date']}</h6>
                                    </td>
                                    <td>
                                        <h6 class="m-b-0 font-16">${data[index]['quantity']}</h6>
                                    </td>
                                    <td>
                                        <label class="badge bg-danger">${data[index]['status']}</label>
                                    </td>
                                    <td>${data[index]['agent']}</td>
                                    <td>
                                        <h5 class="m-b-0">$ ${data[index]['sale']}</h5>
                                    </td>
                                    <td>
                                        <h5 class="m-b-0">$${data[index]['earning']}</h5>
                                    </td>
                                </tr>`;

            $("#tbd").html(row_html);
        }
    }

    function load_sales_table() {
        $("#pending_spin").toggle();
        $.ajax({
            url: './sales/display',
            contentType: false,
            processData: false,
            type: "GET",
            success: function (message) {
                //console.log(message);
                message = JSON.parse(message);
                table_filler(message['data']);
                console.log(message['message']);
                $("#pending_spin").toggle();
            },
            error: function (error) {
                console.log(error);
                $("#pending_spin").toggle();
            }
        })
    }

    $(document).ready(() => {

        $("#upload").on("click", e => handle_uploading(e));

        load_sales_table();
    })
</script>
