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
                            <div id="total_animal" class="card ppointer" style="background-color:#dd433d; color:white;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Sales</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="truck"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 id="total" class="mt-1 mb-3">2.382</h1>
                                    <div class="mb-0">
                                        <span class="badge badge-primary-light"> <i
                                                class="mdi mdi-arrow-bottom-right"></i> -3.65% </span>
                                        <span class="text-muted">Since last week</span>
                                    </div>
                                </div>
                            </div>
                            <div id="healthy_animal" class="card ppointer my-3 cl-text" style="background-color:#003f5c; color:white;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Visitors</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="users"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 id="unhealth" class="mt-1 mb-3">14.212</h1>
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
                                            <h5 class="card-title">Earnings</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="dollar-sign"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 id="health" class="mt-1 mb-3">$21.300</h1>
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
                                            <h5 class="card-title">Orders</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="shopping-cart"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 id="pg" class="mt-1 mb-3">64</h1>
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
                <div class="col-12 col-lg-6">
                    <div class="card flex-fill w-100 lightcard">
                        <div class="card-header text2">
                            <h5 class="card-title">Production Graph</h5>
                            <h6 class="card-subtitle text-muted">An insight to the previous milk production data</h6>
                        </div>
                        <div class="card-body">
                            <div class="chart" style="height: 226px;">
                                <canvas id="dummy"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="card flex-fill w-100 lightcard">
                        <div class="card-header text2">
                            <h5 class="card-title">Production Graph</h5>
                            <h6 class="card-subtitle text-muted">An insight to the previous milk production data</h6>
                        </div>
                        <div class="card-body">
                            <div class="chart" style="height: 226px;">
                                <canvas id="feeddata"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        



    </div>
    <div class="activity">
        <div class="title">
            <i class="uil uil-clock-three"></i>
            <span class="text">Recent Activity</span>
        </div>
        <div class="activity-data">
            <div class="data names">
                <span class="data-title">Name</span>
            </div>
            <div class="data email">
                <span class="data-title">Email</span>
            </div>
            <div class="data joined">
                <span class="data-title">Joined</span>
            </div>
            <div class="data type">
                <span class="data-title">Type</span>
                <span class="data-list">doctor</span>
            </div>
            <div class="data status">
                <span class="data-title">Status</span>
                <span class="data-list">Liked</span>
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
        success: (data) => {
            data = JSON.parse(data);
            $("#health").text(data['healthy']);
            $("#pg").text(data['pg']);
            $("#total").text(data["total"]);
            $("#unhealth").text(data['unhealthy']);
        },
        error: (error) => {
            console.log("The error");
        }

    })

    function Line_Graph_Load() {
        let config = {
            type: "line",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Sales ($)",
                    fill: true,
                    borderColor: '#0288d1',
                    backgroundColor: "transparent",
                    data: [2115, 1562, 1584, 1892, 1487, 2223, 2966, 2448, 2905, 3838, 2917, 3327]
                }, {
                    label: "Orders",
                    fill: true,
                    backgroundColor: "transparent",
                    borderColor: "#66bb6a",
                    borderDash: [4, 4],
                    data: [958, 724, 629, 883, 915, 1214, 1476, 1212, 1554, 2128, 1466, 1827]
                }]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                tooltips: {
                    intersect: false
                },
                hover: {
                    intersect: true
                },
                plugins: {
                    filler: {
                        propagate: false
                    }
                },
                scales: {
                    xAxes: [{
                        reverse: true,
                        gridLines: {
                            color: "rgba(0,0,0,0.05)"
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            stepSize: 500
                        },
                        display: true,
                        borderDash: [5, 5],
                        gridLines: {
                            color: "rgba(0,0,0,0)",
                            fontColor: "#fff"
                        }
                    }]
                }
            }
        }
        new Chart($("#dummy"), config);
        new Chart($("#dd3"), config);
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

        feed_chart();
        Line_Graph_Load();
    })



</script>
