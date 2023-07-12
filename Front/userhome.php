<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Material Design for Bootstrap</title>
    <!-- MDB icon -->
    <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    />
    <!-- Google Fonts Roboto -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"
    />
    <!-- MDB -->
    <link rel="stylesheet" href="css/mdb.min.css" />
  </head>

  <style>
  .btn-border {
    border: 2px solid #ffffff; /* Replace #ffffff with the desired border color */
    background-color: black; /* Replace #ff0000 with the desired background color */
    color: #ffffff; /* Replace #ffffff with the desired text color */
  }
</style>

  <body>

  <?php
    $error_message;
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION['type'])) {
        // echo "here";
        if ($_SESSION['type'] === 'user') {
           
           
            // header("Location: ./userhome");
        } elseif ($_SESSION['type'] === 'admin') {
            // header("Location: ./home");
        }
    } ?>
    <!--Main Navigation-->
<header>
  <!-- Jumbotron -->
  <div class="p-3 text-center bg-white border-bottom">
    <div class="container">
      <div class="row gy-3">
        <!-- Left elements -->
        <div class="col-lg-2 col-sm-4 col-4">
          <a href="https://mdbootstrap.com/" target="_blank" class="float-start">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/bb/DairyFarm_logo.svg/1280px-DairyFarm_logo.svg.png" height="45" />
          </a>
        </div>
        <!-- Left elements -->

        <!-- Center elements -->
        <div class="order-lg-last col-lg-5 col-sm-8 col-8">
          <div class="d-flex float-end">
            <a href="https://github.com/mdbootstrap/bootstrap-material-design" class="me-1 border rounded py-1 px-3 nav-link d-flex align-items-center" target="_blank"> <i class="fas fa-user-alt m-1 me-md-2"></i><p class="d-none d-md-block mb-0">Signed in</p> </a>
            
          </div>
        </div>
        <!-- Center elements -->

        <!-- Right elements -->
        <div class="col-lg-5 col-md-12 col-12">
          <div class="input-group float-center">
            <div class="form-outline">
              <input type="search" id="form1" class="form-control" />
              <label class="form-label" for="form1">Search</label>
            </div>
            <button type="button" class="btn btn-primary shadow-0">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
        <!-- Right elements -->
      </div>
    </div>
  </div>
  <!-- Jumbotron -->

<!-- Heading -->
<div class="bg-primary mb-4">
  <div class="container py-4">
    <h3 class="text-white mt-2">Dairy Fresh</h3>
    <!-- Breadcrumb -->
    <nav class="d-flex justify-content-between align-items-center mb-2">
      <div>
        <a href="" class="text-white-50">Home</a>
        <span class="text-white-50 mx-2"> > </span>
        <a href="" class="text-white">Products</a>
      </div>
      <button class="btn btn-primary btn-border" id="buyNowButton">Buy Now</button>
    </nav>
    <!-- Breadcrumb -->
  </div>
</div>
<!-- Heading -->

 

</header>


<!-- sidebar + content -->
<section class="">
  <div class="container">
    <div class="row">
      <div class="col-lg-3">
          <div class="col-lg-9">
        <!-- Toggle button -->
       
        <!-- Collapsible wrapper -->
        <div class="collapse card d-lg-block mb-5" id="navbarSupportedContent">
          <div class="accordion" id="accordionPanelsStayOpenExample">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button
                        class="accordion-button text-dark bg-light"
                        type="button"
                        data-mdb-toggle="collapse"
                        data-mdb-target="#panelsStayOpen-collapseOne"
                        aria-expanded="true"
                        aria-controls="panelsStayOpen-collapseOne"
                        >
                  Related items
                </button>
              </h2>
              <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne">
                <div class="accordion-body">
                  <ul class="list-unstyled">
                    <li><a href="#" class="text-dark">Lactose Free Milk</a></li>
                    <li><a href="#" class="text-dark"> Soy Milk</a></li>
                    <li><a href="#" class="text-dark"> Sour Cream </a></li>
                    <li><a href="#" class="text-dark"> Cottage Cheese </a></li>
                    <li><a href="#" class="text-dark"> Desi Ghee </a></li>
                    <li><a href="#" class="text-dark"> Heavy Cream </a></li>
                    <li><a href="#" class="text-dark"> Mozarella Cheese</a></li>
                    <li><a href="#" class="text-dark"> Butter </a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingTwo">
                
              </h2>
              <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo">
                <div class="accordion-body"style="display: none;">
                  <div style="display: none;">
                    <!-- Checked checkbox -->
                    <div class="form-check">
                     
                    </div>
                    <!-- Checked checkbox -->
                    <div class="form-check">
                     
                    </div>
                    <!-- Checked checkbox -->
                    <div class="form-check">
                     
                    </div>
                    <!-- Checked checkbox -->
                    <div class="form-check">
                     
                    </div>
                    <!-- Default checkbox -->
                    <div class="form-check">
                     
                    </div>
                    <!-- Default checkbox -->
                    
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              
            </div>
            <div class="accordion-item">
              
            </div>
            <div class="accordion-item">
              
            </div>
          </div>
        </div>
      </div>
      <!-- sidebar -->
      <!-- content -->

      











      <div class="col-lg-9">
          

<section>
<header class="d-sm-flex align-items-center border-bottom mb-4 pb-3">
  <div class="text-center container py-5">
    <h4 class="mt-4 mb-5"><strong>Bestsellers</strong></h4>

    <div class="row">
    <?php
                    // Replace the database credentials with your own
                    $servername = "localhost:3306";
                    $username = "root";
                    $password = "";
                    $dbname = "dairy";

                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Fetch all products from the database
                    $sql = "SELECT * FROM products";
                    $result = $conn->query($sql);
                    include "./Backend/links.php";
                    // Loop through the results and generate Bootstrap cards
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $productName = $row["productname"];
                            $productPrice = $row["price"];
                            $productDescription = $row["description"];

                            ?>

<div class="col-lg-4 col-md-12 mb-4">
        <div class="card">
          <div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light"
            data-mdb-ripple-color="light">
            <img src=<?php try{ echo $img_link[explode("-",$productName)[0]]; } catch(Exception $ex){} ?>
              class="w-100" />
            <a href="#!">
              <div class="mask">
                <div class="d-flex justify-content-start align-items-end h-100">
                  <h5><span class="badge bg-primary ms-2">New</span></h5>
                </div>
              </div>
              <div class="hover-overlay">
                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
              </div>
            </a>
          </div>
          <div class="card-body">
            <a href="" class="text-reset">
              <h5 class="card-title mb-3"><?php echo $productName; ?></h5>
            </a>
            <a href="" class="text-reset">
              <p><?php echo $productDescription; ?></p>
            </a>
            <h6 class="mb-3"><?php echo $productPrice; ?> Rs</h6>
          </div>
        </div>
      </div>

                            <?php
                        }
                    } else {
                        echo "<p class='text-center'>No products found.</p>";
                    }

                    // Close the database connection
                    $conn->close();
                    ?>
      

      

     
     </div>

    
  </div>
</header>
</section>
 
      </div>
  </div>
  </div>
</section>


<!-- Footer -->
<footer class="text-center text-lg-start text-muted bg-primary mt-3">
  <!-- Section: Links  -->
  <section class="">
    <div class="container text-center text-md-start pt-4 pb-4">
      <!-- Grid row -->
      <div class="row mt-3">
        <!-- Grid column -->
        <div class="col-12 col-lg-3 col-sm-12 mb-2">
          <!-- Content -->
          <ahref="https://upload.wikimedia.org/wikipedia/commons/thumb/b/bb/DairyFarm_logo.svg/1280px-DairyFarm_logo.svg.png" target="_blank" class="text-white h2">
            OK Fine Dairy
          </ahref=>
          <p class="mt-1 text-white">
            © 2023 Copyright: OkFineDairy.com
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-6 col-sm-4 col-lg-2">
          <!-- Links -->
          <h6 class="text-uppercase text-white fw-bold mb-2">
            Store
          </h6>
          <ul class="list-unstyled mb-4">
            <li><a class="text-white-50" href="#">About us</a></li>
            
          </ul>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-6 col-sm-4 col-lg-2">
          <!-- Links -->
          <h6 class="text-uppercase text-white fw-bold mb-2">
            Information
          </h6>
          <ul class="list-unstyled mb-4">
            <li><a class="text-white-50" href="#">Help center</a></li>
            <li><a class="text-white-50" href="#">Money refund</a></li>
            <li><a class="text-white-50" href="#">Shipping info</a></li>
            <li><a class="text-white-50" href="#">Refunds</a></li>
          </ul>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-6 col-sm-4 col-lg-2">
          <!-- Links -->
          <h6 class="text-uppercase text-white fw-bold mb-2">
            Support
          </h6>
          <ul class="list-unstyled mb-4">
            <li><a class="text-white-50" href="#">Help center</a></li>
            <li><a class="text-white-50" href="#">Documents</a></li>
            <li><a class="text-white-50" href="#">Account restore</a></li>
            <li><a class="text-white-50" href="#">My orders</a></li>
          </ul>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-12 col-sm-12 col-lg-3">
          <!-- Links -->
          <h6 class="text-uppercase text-white fw-bold mb-2">Newsletter</h6>
          <p class="text-white">Stay in touch with latest updates about our products and offers</p>
          <div class="input-group mb-3">
            <input type="email" class="form-control border" placeholder="Email" aria-label="Email" aria-describedby="button-addon2" />
            <button class="btn btn-light border shadow-0" type="button" id="button-addon2" data-mdb-ripple-color="dark">
              Join
            </button>
          </div>
        </div>
        <!-- Grid column -->
      </div>
      <!-- Grid row -->
    </div>
  </section>
  <!-- Section: Links  -->

  <div class="">
    <div class="container">
      <div class="d-flex justify-content-between py-4 border-top">
        <!--- payment --->
        <div>
          <i class="fab fa-lg fa-cc-visa text-white"></i>
          <i class="fab fa-lg fa-cc-amex text-white"></i>
          <i class="fab fa-lg fa-cc-mastercard text-white"></i>
          <i class="fab fa-lg fa-cc-paypal text-white"></i>
        </div>
        <!--- payment --->

        <!--- language selector --->
        <div class="dropdown dropup">
          <a class="dropdown-toggle text-white" href="#" id="Dropdown" role="button" data-mdb-toggle="dropdown" aria-expanded="false"> <i class="flag-united-kingdom flag m-0 me-1"></i>English </a>

          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="Dropdown">
            <li>
              <a class="dropdown-item" href="#"><i class="flag-united-kingdom flag"></i>English <i class="fa fa-check text-success ms-2"></i></a>
            </li>
            <li><hr class="dropdown-divider" /></li>
            <li>
              <a class="dropdown-item" href="#"><i class="flag-poland flag"></i>Polski</a>
            </li>
            <li>
              <a class="dropdown-item" href="#"><i class="flag-china flag"></i>中文</a>
            </li>
            <li>
              <a class="dropdown-item" href="#"><i class="flag-japan flag"></i>日本語</a>
            </li>
            <li>
              <a class="dropdown-item" href="#"><i class="flag-germany flag"></i>Deutsch</a>
            </li>
            <li>
              <a class="dropdown-item" href="#"><i class="flag-france flag"></i>Français</a>
            </li>
            <li>
              <a class="dropdown-item" href="#"><i class="flag-spain flag"></i>Español</a>
            </li>
            <li>
              <a class="dropdown-item" href="#"><i class="flag-russia flag"></i>Русский</a>
            </li>
            <li>
              <a class="dropdown-item" href="#"><i class="flag-portugal flag"></i>Português</a>
            </li>
          </ul>
        </div>
        <!--- language selector --->
      </div>
    </div>
  </div>
</footer>







    <!-- End your project here-->

    <!-- MDB -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>
    <script>
  document.getElementById('buyNowButton').addEventListener('click', function() {
    window.location.href = './Front/ex.php'; // Replace 'another-page.html' with the desired URL of the page you want to redirect to
  });
</script>
  </body>
</html>
