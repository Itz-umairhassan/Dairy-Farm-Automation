<?php
require_once("./Backend/Helpers.php");
$helper = new Helper();

$parsed = $helper->parser($_SERVER['QUERY_STRING']);
?>

<style>
    .chartWrapper {
        position: relative;
    }

    .chartWrapper>canvas {
        position: absolute;
        left: 0;
        top: 0;
        pointer-events: none;
    }

    .chartAreaWrapper {
        width: 600px;
        overflow-x: scroll;
    }

</style>

<div class="dash-content">

    <div class="title heading">
        <span class='text'>Animal Details with id
            <?php echo $parsed['id'] ?>
        </span>

    </div>

    <div>

        <div>
            <h3 class='light'> <span class='head'>ID: </span> <span id="idd" class='data'>
                    <?php echo $parsed['id'] ?>
                </span> </h3>
        </div>

        <div>
            <h3 class='light'> <span class='head'>Price: </span> <span id="pdd" class='data'></span> </h3>
        </div>
        <div>
            <h3 class='light'> <span class='head'>Group: </span> <span id="gdd" class='data'></span> </h3>
        </div>
        <div>
            <h3 class='light'> <span class='head'>Breed: </span> <span id="bdd" class='data'></span> </h3>
        </div>
        <div class='d-flex  justify-content-start'>

            <h3 class='light'> <span class='head'>Health: </span> <span id="hdd" class='data'></span> </h3>

            <!-- Default checked -->
            <div id="cc1" class="custom-control mx-4 custom-switch">
            </div>
        </div>

        <div class='d-flex  justify-content-start'>

            <h3 class='light'> <span class='head'>Preg: </span> <span id="prdd" class='data'></span> </h3>

            <!-- Default checked -->
            <div id="cc2" class="custom-control mx-4 custom-switch">
            </div>
        </div>


    </div>

    <div class="container-sm">
        <canvas id="myChart" class="container-sm"></canvas>
    </div>
</div>


<script>

    //const xValues = [100,200,300,400,500,600,700,800,900,1000];
    const xValues = ['one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten'];
    let production_details = null;



    // here ends the charts related data and starts queries....
    // function formulate_data(production) {
    //     let dates = [];
    //     // first let's calculate previous 10 dates...
    //     let new_date = new Date().toISOString().split('T')[0];
    //     let mydata = [];


    //     let dd; let obj;

    //     for (let i = 0; i < 7; i++) {
    //         dd = new Date(Date.now() - (7 - i - 1) * 24 * 60 * 60 * 1000);
    //         dd = dd.toISOString().split('T')[0];
    //         dates.push(dd);
    //         mydata[i] = 0;

    //         for (let k in production_details) {
    //             obj = production_details[k];

    //             if (obj['date'] == dd) {
    //                 mydata[i] = parseInt(obj['milk']);
    //                 break;
    //             }
    //         }

    //     }

    //     // xValues = dates;

    //     new Chart("myChart", {
    //         type: "line",
    //         data: {
    //             labels: dates,
    //             datasets: [{
    //                 data: mydata,
    //                 borderColor: "red",
    //                 fill: false
    //             }]
    //         },
    //         options: {
    //             legend: { display: false }
    //         }
    //     });
    // }
    // function formulate_data(production)
    //  {
    //     let dates = [];
    //     // first let's calculate previous 10 dates...
    //     let new_date = new Date().toISOString().split('T')[0];
    //     let mydata = [];


    //     let dd; let obj;

    //     for (let i = 0; i < 7; i++) {
    //         dd = new Date(Date.now() - (7 - i - 1) * 24 * 60 * 60 * 1000);
    //         dd = dd.toISOString().split('T')[0];
    //         dates.push(dd);
    //         mydata[i] = 0;

    //         for (let k in production_details) {
    //             obj = production_details[k];

    //             if (obj['date'] == dd) {
    //                 mydata[i] = parseInt(obj['milk']);
    //                 break;
    //             }
    //         }

    //     }
     


    //    const data= {
    //             labels: dates,
    //             datasets: [{
    //                 label: " Data",
    //                 barPercentage: 0.5,
    //             barThickness: 6,
    //             maxBarThickness: 8,
    //             minBarLength: 2,
    //             borderRadius: 19,
    //             //my data array
    //                 data: mydata,
    //               //  borderColor: "red",
    //                 backgroundColor: 'rgb(132,140,207)'
    //                // fill: false
    //             }]
            
        
    //     };

    //     const config = {
    //         type: 'bar',
    //         data: data,
    //         options: {
    //             scales: {
    //                 y: {
    //                     beginAtZero: true
    //                 }
    //             }
    //         }
    //     };
    //     // xValues = dates;

    //     new Chart("myChart",config);
      
    // }




    function fetch_animal_details() {
        let url = './details/get';
        let id = $("#idd").text();

        let data = new FormData();
        data.append("animal_id", id);

        $.ajax({
            url: './details/get',
            type: 'post',
            data: data,
            contentType: false,
            processData: false,
            success: (data) => {
                let fetched_data = JSON.parse(data);
                $("#pdd").text(fetched_data['price']);

                let ss1 = `<input type="checkbox" class="custom-control-input" id="health" ${fetched_data['healthy'] == '1' ? `checked` : ''}>
                <label class="custom-control-label light" for="health">Change health status</label>
           `;
                let cc2 = `<input type="checkbox" class="custom-control-input" id="preg" ${fetched_data['preg'] == true ? 'checked' : ''}>
                <label class="custom-control-label light" for="preg">Change pregnant status</label>
            `;

                $("#cc1").html(ss1);
                $("#cc2").html(cc2);
                $("#hdd").text(fetched_data['healthy'] == '1' ? 'YES' : "NO");
                $("#prdd").text(fetched_data['preg'] ? "YES" : "NO");
                $("#gdd").text(fetched_data['group']);
                $("#bdd").text(fetched_data['species']);

                production_details = fetched_data['production'];

                formulate_data();
            },
            error: (message) => {
                console.log(message);
            }
        })

    }

    $(document).ready(() => {
        fetch_animal_details();
    })

</script>
