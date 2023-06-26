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

    <div class="switch-section">
      <span class="text head">Health:</span>
      <span id="hdd" class="text data"></span>
      <div id="cc1" class="custom-control mx-4 custom-switch"></div>
    </div>

    <div class="switch-section text">
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

        <div class="card-body">
          <div class="chart" style="height: 226px;">
            <canvas id="mychart"></canvas>
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

        // set all production details into the graph... 
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
