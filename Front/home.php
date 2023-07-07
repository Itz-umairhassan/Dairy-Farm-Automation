<div class="dash-content">

    <div class="overview">
        <div class="title">
            <i class="uil uil-tachometer-fast-alt"></i>
            <span class="text">Animals Overview</span>
        </div>

        <div class="container">

            <div class="row">
                <div class="col-xl-6 col-xxl-5 d-flex">
                    <div class="w-100">
                        <div class="row">
                            <div class="col-sm-6">
                                <div id="total_animal" class="card ppointer"
                                    style="background-color:#dd433d; color:white;">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">Total Animals</h5>
                                            </div>

                                            <div class="col-auto">
                                                <div class="stat text-primary">
                                                    <i class="align-middle" data-feather="truck"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <h1 id="total" class="mt-1 mb-3">--</h1>
                                        <div class="mb-0">
                                            <span class="badge badge-primary-light"> <i
                                                    class="mdi mdi-arrow-bottom-right"></i> -3.65% </span>
                                            <span class="text-muted">Since last week</span>
                                        </div>
                                    </div>
                                </div>
                                <div id="healthy_animal" class="card ppointer my-3 cl-text"
                                    style="background-color:#003f5c; color:white;">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">Sick Animals</h5>
                                            </div>

                                            <div class="col-auto">
                                                <div class="stat text-primary">
                                                    <i class="align-middle" data-feather="users"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <h1 id="unhealth" class="mt-1 mb-3">--</h1>
                                        <div class="mb-0">
                                            <span class="badge badge-success-light"> <i
                                                    class="mdi mdi-arrow-bottom-right"></i> 5.25% </span>
                                            <span class="text-muted">Since last week</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div id="unhealthy_animal" class="card ppointer">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">Healthy Animals</h5>
                                            </div>

                                            <div class="col-auto">
                                                <div class="stat text-primary">
                                                    <i class="align-middle" data-feather="dollar-sign"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <h1 id="health" class="mt-1 mb-3">--</h1>
                                        <div class="mb-0">
                                            <span class="badge badge-success-light"> <i
                                                    class="mdi mdi-arrow-bottom-right"></i> 6.65% </span>
                                            <span class="text-muted">Since last week</span>
                                        </div>
                                    </div>
                                </div>
                                <div id="pregnant_animal" class="card my-3 ppointer lightcard cl-text">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">Pregnant Animals</h5>
                                            </div>

                                            <div class="col-auto">
                                                <div class="stat text-primary">
                                                    <i class="align-middle" data-feather="shopping-cart"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <h1 id="pg" class="mt-1 mb-3">--</h1>
                                        <div class="mb-0">
                                            <span class="badge badge-danger-light"> <i
                                                    class="mdi mdi-arrow-bottom-right"></i> -2.25% </span>
                                            <span class="text-muted">Since last week</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-xxl-7">
                    <div class="card flex-fill w-100 lightcard text2">
                        <div class="card-header">

                            <h5 class="card-title mb-0">Animal Details</h5>
                        </div>
                        <div class="card-body pt-2 pb-3">
                            <div class="chart chart-sm" style="height:300px;">
                                <canvas id="dd3"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row my-4">
                <div class="col-12 col-lg-6 my-3">
                    <div class="card flex-fill w-100 lightcard">
                        <div class="card-header text2">
                            <h5 class="card-title">Production Graph</h5>
                            <h6 class="card-subtitle text-muted">An insight to the previous milk production data</h6>
                        </div>
                        <div class="card-body">
                            <div class="chart" style="width:100%;">
                                <div id="production_chart"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6 my-3">

                    <div class="card flex-fill lightcard text2">
                        <div class="card-header">

                            <h5 class="card-title mb-0">Pending Sales</h5>
                        </div>
                        <div class="card-body pt-2 pb-3">
                            <div class="table-responsive">
                                <table class="table mb-0 align-middle text-nowrap lightcard cl-text">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">Date</th>
                                            <th class="border-top-0">Quantity</th>
                                            <th class="border-top-0">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_body">

                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-center text-danger my-4">
                                <div id="pending_spin" class="spinner-border" role="status" style="display:none;">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>




    </div>

</div>
</section>


<script>

    function feed_chart() {

        const labels = ["Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
        const data = {
            labels: labels,
            datasets: [{
                label: "Production Data",
                barPercentage: 0.5,
                barThickness: 6,
                maxBarThickness: 8,
                minBarLength: 2,
                borderRadius: 19,
                maintainAspectRatio: false,
                data: [20, 30, 40, 50, 60, 70],
                backgroundColor: '#d32f2f'
                //backgroundColor:['rgb(10,10,255)','rgb(0,0,255)','rgb(0,0,255)','rgb(0,0,255)','rgb(0,0,255)','rgb(0,0,255)','rgb(0,0,255)']
            }]
        };

        const config = {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    },
                    x: {
                        ticks: {
                            font: {
                                size: 12,
                                family: 'poppins'
                            }
                        }
                    }
                },

            }
        };


        new Chart($("#feeddata"), config);
    }

    // first of all get the overview related data from the backend and display it here on page...
    $.ajax({
        url: './home/overview',
        contentType: false,
        processData: false,
        type: 'GET',
        success: (message) => {
            message = JSON.parse(message);
            data = message['overview'];
            $("#health").text(data['healthy']);
            $("#pg").text(data['pg']);
            $("#total").text(data["total"]);
            $("#unhealth").text(data['unhealthy']);

            Line_Graph_Load(message['history']);
            plot_this_chart(message['history']);
        },
        error: (error) => {
            console.log("The error");
        }

    })

    function load_pending_sales() {

        let rows_html = "";
        let max_index = 0;
        $("#pending_spin").toggle();
        $.ajax({
            url: './sales/get',
            contentType: false,
            processData: false,
            type: 'GET',
            success: function (message) {
                message = JSON.parse(message);
                for (let index in message) {
                    max_index++;
                    rows_html += `  <tr class='click_tr'>
                                 <td>${message[index][0]}</td>
                                 <td>${message[index][1]}</td>
                                <td><label class="badge bg-danger">Pending</label></td>
                                <td onClick="Sell_this(event)" style="cursor:pointer;" class="sale_change text-danger">Change </td>
                             </tr>`

                    if (max_index > 4) break;
                }

                // now set it into the table body
                $("#table_body").html(rows_html);
                $("#pending_spin").toggle();

            },
            error: function (message) {
                $("#pending_spin").toggle();
                console.log(message);
            }
        })
    }



    function Sell_this(event) {
        console.log("Sending request_data");
        let agent_name = "AMC Dairy";
        let price = 100;
        let parent_elem = event.target.parentElement;
        let date = event.target.parentElement.firstElementChild.innerText;

        let spinner_html = `<div class="d-flex justify-content-center">
                                <div class="spinner-border" role="status" >
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>`;

        $(event.target).html(spinner_html);

        let request_data = new FormData();

        request_data.append("agent", agent_name);
        request_data.append("price", price);
        request_data.append("date", date);

        $.ajax({
            url: "./sales/sold",
            processData: false,
            contentType: false,
            type: 'POST',
            data: request_data,
            success: function (message) {
                console.log(JSON.parse(message));
                $(parent_elem).hide();
            },
            error: function (message) {
                console.log(message);
            }
        })

    }

    $(document).ready(() => {
        $("#total_animal").click(() => {
            window.location.href = './animal?type=all';
        })

        $("#healthy_animal").click(() => {
            window.location.href = './animal?type=healthy';
        })
        $("#unhealthy_animal").click(() => {
            window.location.href = './animal?type=unhealthy';
        })
        $("#pregnant_animal").click(() => {
            window.location.href = './animal?type=pregnant';
        })

        load_pending_sales();
        feed_chart();

    })



</script>
