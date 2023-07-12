<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Login Page</title>
    <meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Custom CSS -->
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>


    <!-- HK Wrapper -->
    <div class="hk-wrapper">

        <!-- Main Content -->
        <div class="hk-pg-wrapper hk-auth-wrapper">
            <header class="d-flex justify-content-between align-items-center">
                <a class="d-flex auth-brand align-items-center" href="#">
                    <span class="text-white font-30">Ok Fine Dairy Shop</span>
                </a>

            </header>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-5 pa-0">
                        <div id="owl_demo_1" class="owl-carousel dots-on-item owl-theme">
                            <div class="fadeOut item auth-cover-img overlay-wrap" style="background-image:url(dist/img/banner2.png);">
                                <div class="auth-cover-info py-xl-0 pt-100 pb-50">
                                    <div class="auth-cover-content text-center w-xxl-75 w-sm-90 w-xs-100">

                                    </div>
                                </div>
                                <div class="bg-overlay bg-trans-dark-50"></div>
                            </div>
                            <div class="fadeOut item auth-cover-img overlay-wrap" style="background-image:url(dist/img/banner1.png);">
                                <div class="auth-cover-info py-xl-0 pt-100 pb-50">
                                    <div class="auth-cover-content text-center w-xxl-75 w-sm-90 w-xs-100">

                                    </div>
                                </div>
                                <div class="bg-overlay bg-trans-dark-50"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7 pa-0">
                        <div class="auth-form-wrap py-xl-0 py-50">
                            <div class="auth-form w-xxl-55 w-xl-75 w-sm-90 w-xs-100">
                                <form method="post" id="loginform">
                                    <h1 class="display-4 mb-10">Welcome Amigo</h1>

                                    <div class="form-group">
                                        First Name <input class="form-control" placeholder="FirstName" type="text" name="fname" required="true" id="fname">
                                    </div>
                                    <div class="form-group">
                                        Last Name <input class="form-control" placeholder="LastName" type="text" name="lname" required="true" id="lname">
                                    </div>
                                    <div class="form-group">
                                        Email <input class="form-control" placeholder="Enter Email" type="email" name="email" required="true" id="email">
                                    </div>
                                    <div class="form-group">
                                        Username <input class="form-control" placeholder="Enter your preferred username" type="text" name="uname" required="true" id="uname">
                                    </div>
                                    <div class="form-group">
                                        Password <input class="form-control" placeholder="Password " type="text" name="password" required="true" id="password">
                                    </div>



                                    <button class="btn btn-warning btn-block" type="submit" name="login" id="login">Signup</button>
                                    <p class="font-14 text-center mt-15" id="lo">Already have an account ?</p>
                                   
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Main Content -->

    </div>
    <!-- /HK Wrapper -->

    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Slimscroll JavaScript -->
    <script src="dist/js/jquery.slimscroll.js"></script>

    <!-- Fancy Dropdown JS -->
    <script src="dist/js/dropdown-bootstrap-extended.js"></script>

    <!-- Owl JavaScript -->
    <script src="vendors/owl.carousel/dist/owl.carousel.min.js"></script>

    <!-- FeatherIcons JavaScript -->
    <script src="dist/js/feather.min.js"></script>

    <!-- Init JavaScript -->
    <script src="dist/js/init.js"></script>
    <script src="dist/js/login-data.js"></script>
</body>





<script>
    $(document).ready(function() {


        var myParagraph = document.getElementById("lo");

        myParagraph.addEventListener("click", function() {
            window.location.href = "./userlogin";
            
        });

        document.getElementById("loginform").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent form submission

            var fname = document.getElementById("fname").value;
            var lname = document.getElementById("lname").value;
            var uname = document.getElementById("uname").value;
            var password = document.getElementById("password").value;
            var email= document.getElementById("email").value;
           
            let formdata = new FormData();
            formdata.append("fname", fname);
            formdata.append("lname", lname);
            formdata.append("uname", uname);
            formdata.append("password", password);
            formdata.append("email", email);
            
            $.ajax({
                type: 'POST',
                url: './usersignup/verify',
                data: formdata,
                contentType: false,
                processData: false,
                success: function(response) {
                    
                    window.location.href = "./userlogin";
                },
                error: function() {
                    alert('An error occurred. Please try again later.');
                }
            });
        });
    });
</script>

</script>

</html>