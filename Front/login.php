<html>

<head>
    <title>LogIn page</title>
    <script src="./JS Scripts/jq.js"></script>
    <link rel="stylesheet" href="./CSS/loginPage.css">
    <link rel="stylesheet" href="./CSS/mainStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

</head>

<body style="background: #214a80;">

    <?php
    $error_message;
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['type'])) {
        header("Location: ./home");
    }
    ?>


    <div class="login-dark" style="height: 100vh;">
        <form method="post">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
            <div class="form-group"><input class="form-control" id="email" type="email" name="email"
                    placeholder="Email"></div>
            <div class="form-group"><input class="form-control" id="password" type="password" name="password"
                    placeholder="Password">
            </div>
            <a id="error" class="error_message" href="#"></a>
            <div class="form-group"><button id="login" class="btn btn-primary btn-block">Log In</button></div>
        </form>
    </div>



    <!-- HERE THE JS CODE STARTS -->

    <script>

        $('#login').on("click", e => {
            e.preventDefault();
            let data = new FormData();
            data.append("email", $("#email").val());
            data.append("password", $("#password").val());
            console.log("Sending message");

            // now send the form data to the url ... post request..
            $.ajax({
                url: './login/verify',
                data: data,
                processData: false,
                contentType: false,
                type: 'POST',
                success: (message, status) => {
                    window.location.href = "./home";
                },
                error: (message, status) => {

                    $("#error").text("Wrong credentials");
                    setTimeout(() => {
                        $("#error").text("");

                    }, 2 * 1000);
                }
            })


        })
    </script>
</body>

</html>
