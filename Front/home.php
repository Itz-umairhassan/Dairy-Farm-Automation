<div class="dash-content">
    <div class="overview">
        <div class="title">
            <i class="uil uil-tachometer-fast-alt"></i>
            <span class="text">Animals Overview</span>
        </div>

        <div class="container">
            <div class="row">
                <div id="total_animal" class="col-md-3 ppointer">
                    <div class="card-counter primary">
                        <i class="fa fa-code-fork"></i>
                        <span id="total" class="count-numbers">--</span>
                        <span class="count-name">Total Animals</span>
                    </div>
                </div>

                <div id="unhealthy_animal" class="col-md-3  ppointer">
                    <div class="card-counter danger">
                        <i class="fa fa-ticket"></i>
                        <span id="unhealth" class="count-numbers">--</span>
                        <span class="count-name">Unhealthy</span>
                    </div>
                </div>

                <div id="healthy_animal" class="col-md-3 ppointer">
                    <div class="card-counter success ">
                        <i class="fa fa-database"></i>
                        <span id="health" class="count-numbers">--</span>
                        <span class="count-name">Healthy</span>
                    </div>
                </div>

                <div id="pregnant_animal" class="col-md-3 ppointer">
                    <div class="card-counter info">
                        <i class="fa fa-users"></i>
                        <span id="pg" class="count-numbers">--</span>
                        <span class="count-name">Pregnant</span>
                    </div>
                </div>
            </div>

            <div class="row my-3">
                <div class="col-md-6 mx-3 lightcard">
                   
                    <canvas id="myChart"></canvas>
                    <div class="heading light my-2">
                        <h5 class='text'>Production Graph</h5>
                        <select name="" class="drop light" id="">
                            <option  value="">One</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-5 mx-3 lightcard ">
                    <canvas id="feedchart"></canvas>
                    <div class="heading light my-4">
                        <h5 class='text'>Feed Graph</h5>
                     
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

    function production_graph() {
        const ctx = document.getElementById('myChart');

        const labels = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
        const data = {
            labels: labels,
            datasets: [{
                label: "Production Data",
                barPercentage: 0.5,
                barThickness: 6,
                maxBarThickness: 8,
                minBarLength: 2,
                borderRadius: 19,
                data: [10, 20, 30, 40, 50, 60, 70],
                backgroundColor: 'rgb(132,140,207)'
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
                    }
                }
            }
        };

        new Chart(ctx, config);
    }

    function feed_chart() {

        const labels = [ "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
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
                backgroundColor: 'rgb(255, 97, 87, 1)'
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
                            font:{
                                size:12,
                                family:'poppins'
                            }
                        }
                    }
                },
                
            }
        };


        new Chart($("#feedchart"), config);
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

        production_graph();
        feed_chart();
    })



</script>
