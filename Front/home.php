<div class="dash-content">
    <div class="overview">
        <div class="title">
            <i class="uil uil-tachometer-fast-alt"></i>
            <span class="text">Animal Overview</span>
        </div>

        <div class="container">
            <div class="row  ppointer">
                <div id="total_animal" class="col-md-3 ">
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
                <span class="data-list">Prem Shahi</span>
                <span class="data-list">Deepa Chand</span>
                <span class="data-list">Manisha Chand</span>
                <span class="data-list">Pratima Shahi</span>
                <span class="data-list">Man Shahi</span>
                <span class="data-list">Ganesh Chand</span>
                <span class="data-list">Bikash Chand</span>
            </div>
            <div class="data email">
                <span class="data-title">Email</span>
                <span class="data-list">premshahi@gmail.com</span>
                <span class="data-list">deepachand@gmail.com</span>
                <span class="data-list">prakashhai@gmail.com</span>
                <span class="data-list">manishachand@gmail.com</span>
                <span class="data-list">pratimashhai@gmail.com</span>
                <span class="data-list">manshahi@gmail.com</span>
                <span class="data-list">ganeshchand@gmail.com</span>
            </div>
            <div class="data joined">
                <span class="data-title">Joined</span>
                <span class="data-list">2022-02-12</span>
                <span class="data-list">2022-02-12</span>
                <span class="data-list">2022-02-13</span>
                <span class="data-list">2022-02-13</span>
                <span class="data-list">2022-02-14</span>
                <span class="data-list">2022-02-14</span>
                <span class="data-list">2022-02-15</span>
            </div>
            <div class="data type">
                <span class="data-title">Type</span>
                <span class="data-list">New</span>
                <span class="data-list">Member</span>
                <span class="data-list">Member</span>
                <span class="data-list">New</span>
                <span class="data-list">Member</span>
                <span class="data-list">New</span>
                <span class="data-list">Member</span>
            </div>
            <div class="data status">
                <span class="data-title">Status</span>
                <span class="data-list">Liked</span>
                <span class="data-list">Liked</span>
                <span class="data-list">Liked</span>
                <span class="data-list">Liked</span>
                <span class="data-list">Liked</span>
                <span class="data-list">Liked</span>
                <span class="data-list">Liked</span>
            </div>
        </div>
    </div>
</div>
</section>


<script>

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
    })
</script>
