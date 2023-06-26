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
                        <table class="table mb-0 table-hover align-middle text-nowrap lightcard cl-text">
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
                            <tbody>
                                
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">

                                            <div class="">
                                                <h6 class="m-b-0 font-16">01</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h6 class="m-b-0 font-16">12-02-2023</h6>
                                    </td>
                                    <td>
                                        <h6 class="m-b-0 font-16">50</h6>
                                    </td>
                                    <td>
                                        <label class="badge bg-danger">low</label>
                                    </td>
                                    <td>TF Products</td>
                                    <td>
                                        <h5 class="m-b-0">$28</h5>
                                    </td>
                                    <td>
                                        <h5 class="m-b-0">$2850.06</h5>
                                    </td>
                                </tr>



                            </tbody>
                        </table>
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
    $(document).ready(() => {

        $("#upload").on("click", e => handle_uploading(e));
    })
</script>
