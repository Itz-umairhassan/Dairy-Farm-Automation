<?php
require_once("./Backend/Helpers.php");
$helper = new Helper();

$parsed = $helper->parser($_SERVER['QUERY_STRING']);
?>

<style>
  .title {
    font-size: 28px;
    font-weight: bold;
    margin-bottom: 20px;
    text-align: center;
  }

  .data-section {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    margin-bottom: 30px;
  }

  .data-item {
    display: flex;
    align-items: center;
    font-size: 18px;
  }

  .data-item .head {
    font-weight: bold;
    margin-right: 10px;
    color: #03a9f4;
    font-size: 20px;
  }

  .switch-section {
    display: flex;
    align-items: center;
    font-size: 18px;
  }

  .switch-section .head {
    font-weight: bold;
    margin-right: 10px;
  }

</style>

<div class="dash-content text2">
  <div class="title heading">
    Animal Details with id
    <?php echo $parsed['id'] ?>
  </div>

  <div class="data-section">
    <div class="data-item">
      <span class="head">ID:</span>
      <span id="idd" class="data">
        <?php echo $parsed['id'] ?>
      </span>
    </div>

    <div class="data-item">
      <span class="head">Price:</span>
      <span id="pdd" class="data"></span>
    </div>

    <div class="data-item">
      <span class="head">Group:</span>
      <span id="gdd" class="data"></span>
    </div>

    <div class="data-item">
      <span class="head">Breed:</span>
      <span id="bdd" class="data"></span>
    </div>

    <div class="switch-section data-item">
      <span class="text head">Health:</span>
      <span id="hdd" class="text data"></span>
      <div id="cc1" class="custom-control mx-4 custom-switch"></div>
    </div>

    <div class="switch-section data-item">
      <span class="head text">Preg:</span>
      <span id="prdd" class="data text"></span>
      <div id="cc2" class="custom-control mx-4 custom-switch"></div>
    </div>
  </div>

  <div class="row">
    <div class="col-12 col-lg-6">
      <div class="card flex-fill w-100 lightcard">

        <div class="card-header text2">
          <h5 class="card-title">Production Graph</h5>
          <h6 class="card-subtitle text-muted">An insight to the previous milk production data</h6>
        </div>

        <div class="spinners text-center" style="display:none">
          <div class="spinner-border text-danger" role="status">
            <span class="sr-only">Loading...</span>
          </div>
        </div>

        <div class="card-body">
          <div class="chart" style="width:100%;">
            <div id="mychart"></div>
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

        <div class="spinners text-center" style="display:none">
          <div class="spinner-border text-danger" role="status">
            <span class="sr-only">Loading...</span>
          </div>
        </div>

        <div class="card-body">
          <div class="chart" style="width:100%;">
            <div id="profit_chart"></div>
          </div>
        </div>

      </div>
    </div>
  </div>

</div>


<script>

  //const xValues = [100,200,300,400,500,600,700,800,900,1000];
  const xValues = ['one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten'];
  let production_details = null;



  function formulate_data() {




    const data = {
      labels: dates,
      datasets: [{


        label: " Data",
        barPercentage: 0.5,
        barThickness: 30, // Increase the value to make the bars thicker
        maxBarThickness: 30, // Increase the value to make the bars thicker
        minBarLength: 2,
        borderRadius: 10,
        data: mydata,
        backgroundColor: 'rgb(132,140,207)'

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
    // xValues = dates;

    new Chart($("#mychart"), config);

  }

  function plot_this_chart() {

    let dates = [];
    // first let's calculate previous 10 dates...
    let new_date = new Date().toISOString().split('T')[0];
    let mydata = [];


    let dd; let obj;

    for (let i = 0; i < 7; i++) {
      dd = new Date(Date.now() - (7 - i - 1) * 24 * 60 * 60 * 1000);
      dd = dd.toISOString().split('T')[0];
      dates.push(dd);
      mydata[i] = 0;

      for (let k in production_details) {
        obj = production_details[k];

        if (obj['date'] == dd) {
          mydata[i] = parseInt(obj['milk']);
          break;
        }
      }

    }

    // plot the graph....of the fetched data....

    var options = {
      series: [{
        name: 'Milk Production',
        data: mydata
      }],
      chart: {
        type: 'bar',
        height: 350
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: '20%',
          endingShape: 'rounded'
        },
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        show: true,
        width: 2,
        colors: ['transparent']
      },
      xaxis: {
        categories: dates,
        title: {
          text: "Date"
        }
      },
      yaxis: {
        labels: {
          style: {
            colors: ['#ffffff'],
            fontSize: '14px',
            fontFamily: 'poppins',
            fontWeight: 400,
            cssClass: 'apexcharts-xaxis-label'
          }
        },
        title: {
          text: 'Produces milk (litre)'
        }
      },
      fill: {
        opacity: 1,
        colors: ['#F44336', '#E91E63', '#9C27B0']
      },
      tooltip: {
        y: {
          formatter: function (val) {
            return "$ " + val + " thousands"
          }
        }
      }
    };

    var chart = new ApexCharts(document.querySelector("#mychart"), options);
    chart.render();
  }

  // PLOT THE GRAPH FOR PROFIT ANALYSIS OF THIS ANIMAL.....
  function plot_profit_loss() {
    var options = {
      series: [{
        name: 'series1',
        data: [31, 40, 28, 51, 42, 109, 100]
      }, {
        name: 'series2',
        data: [11, 32, 45, 32, 34, 52, 41]
      }],
      chart: {
        height: 350,
        type: 'area'
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'smooth'
      },
      xaxis: {
        type: 'datetime',
        categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
      },
      tooltip: {
        x: {
          format: 'dd/MM/yy HH:mm'
        },
      },
    };

    var chart = new ApexCharts(document.querySelector("#profit_chart"), options);
    chart.render();
  }


  function fetch_animal_details() {
    $(".spinners").toggle();
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

        // set all production details into the graph... 
        production_details = fetched_data['production'];

        plot_this_chart();
        plot_profit_loss();
        $(".spinners").toggle();
      },
      error: (message) => {
        $(".spinners").toggle();
        console.log(message);
      }
    })

  }

  $(document).ready(() => {
    fetch_animal_details();
  })

</script>
