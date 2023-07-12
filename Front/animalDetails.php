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
  <?php
  include './Front/alert.php';
  ?>

  <div class="title heading">
    <div class="text"> Animal Details 
    </div>

    <h5 class="foooo" id="msg" style="color:green; margin-left:10px;"></h5>
    <div>
      <button id="changes_btn" type="button" class="btn btn-primary">Save Changes</button>
    </div>
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

    <div class="switch-section data-item">
      <span class="head text">Diet Plan:</span>
      <span id="dietplan" class="data text">
        <select class="drop light mx-3" name="" id="plans">
          <option value="--"> -- </option>;
        </select>
      </span>
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
          <h5 class="card-title">Profit Analysis</h5>
          <h6 class="card-subtitle text-muted">An overview of Earning and Spendings related to this animal</h6>

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

  let diet_plan = "Normal";
  let all_options = [];
  let verify_spinner = `  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Verifying changes...`;
  let uploading_spinner = `  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Uploading changes...`;

  //////////////////////////////////////////////////////////////////////////////////////
  /////////////////////////////// TAKE VALUES AND FILL OUT THE PAGE   /////////////////

  function make_options(fetched_data) {
    let plan_options = ``;
    all_options = fetched_data['dietplan'];

    for (let i in fetched_data['dietplan']) {
      plan_options += `<option value='${fetched_data['dietplan'][i]}'> ${fetched_data['dietplan'][i]} </option>;`;
    }

    $("#plans").html(plan_options);
    diet_plan = fetched_data['dietplan'][0];
  }

  function Filler(fetched_data) {
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

    make_options(fetched_data);
  }

  //////////////////////////////////////////////////////////////////////////////////////
  //////////////////////////////////////////////////////////////////////////////////////

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

        Filler(fetched_data);

        // set all production details into the graph... 
        let production_details = fetched_data['production'];

        console.log(production_details);
        let dataset = find_labels(production_details, "days");
        plot_bar_graph(dataset, "#mychart");

        // NOW PLOT PROFIT LOSS GRAPH...
        let dataseries = [{
          name: 'Earning',
          data: [31, 40, 28, 51, 42, 109, 100]
        }, {
          name: 'Spending',
          data: [11, 32, 45, 32, 34, 52, 41]
        }];

        plot_line_graph(dataseries, "#profit_chart");
        $(".spinners").toggle();
      },
      error: (message) => {
        $(".spinners").toggle();
        console.log(message);
      }
    })

  }

  //////////////////////////////////////////////////////////////////////////////////////
  function save_changes(btn) {

    if ($("#plans").val() !== diet_plan) {
      let formdata = new FormData();
      $(btn).html(uploading_spinner);

      formdata.append("animalid",<?php echo $parsed['id']; ?>)
      formdata.append("newplan", $("#plans").val());
      formdata.append("oldplan", diet_plan);
      $.ajax({
        url: "./planchange",
        data: formdata,
        method: "POST",
        processData: false,
        contentType: false,
        success: (message) => {
          message = JSON.parse(message);
          console.log(message);

          $("#alert_status").text("Success !");
          $("#alert_message").text(message['message']);
          $(".alert").toggle();

          setTimeout(() => {
            $(".alert").toggle();
          }, 1000 * 2);

          $(btn).html("Save Changes");
          // NOW SET NEW PLAN AS THE ORIGINAL DIET PLAN...
          diet_plan = $("#plans").val();
        },
        error: (err) => {
          err = JSON.parse(err);
          $(".alert").toggle();
          $(".alert").removeClass("alert-success");
          $(".alert").addClass("alert-danger");
          $("#alert_status").text("Error !");
          $("#alert_message").text(err['message']);

          $(btn).html("Save Changes");

          setTimeout(() => {
            $(".alert").toggle();
            $(".alert").removeClass("alert-danger");
            $(".alert").addClass("alert-success");
          }, 1000 * 2.5);

        }

      })
    } else {

      $(".alert").toggle();
      $(".alert").removeClass("alert-success");
      $(".alert").addClass("alert-danger");
      $("#alert_status").text("Error !");
      $("#alert_message").text("No change detected");

      $(btn).html("Save Changes");

      setTimeout(() => {
        $(".alert").toggle();
        $(".alert").removeClass("alert-danger");
        $(".alert").addClass("alert-success");
      }, 1000 * 2.5);

    }

  }

  ///////////////////////////////////////////////////////
  $(document).ready(() => {
    fetch_animal_details();

    $("#changes_btn").on("click", event => {
      event.preventDefault();
      let e = $("#changes_btn")[0];
      $(e).html(verify_spinner);
      save_changes(e);
    })
  })

</script>
