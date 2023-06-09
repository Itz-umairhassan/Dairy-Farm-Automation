<html>

<head>
    <?php $size = count(explode('/', $_SERVER['PATH_INFO'])) - 1;
    $dots = './';
    for ($i = 1; $i < $size; $i++) {
        if($i==1) $dots='../';
       else  $dots .= '../';
    }
    //echo "This time " . $dots;
    ?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="./CSS/mainStyle.css">

    <script src=<?php echo $dots . "JS%20Scripts/jq.js"; ?>></script>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <link rel="stylesheet" href=<?php echo $dots . 'CSS/style.css'; ?>>
</head>

<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="images/logo.png" alt="">
            </div>
            <span class="logo_name">CodingLab</span>
        </div>
        <div class="menu-items">
            <ul class="nav-links">
                <li><a href=<?php echo $dots.'farm/home'; ?>>
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Dahsboard</span>
                    </a></li>
                <li><a href=<?php echo $dots.'farm/animal'; ?> >
                        <i class="uil uil-files-landscapes"></i>
                        <span class="link-name">Animals</span>
                    </a></li>
                <li><a href="#">
                        <i class="uil uil-chart"></i>
                        <span class="link-name">Analytics</span>
                    </a></li>
                <li><a href="#">
                        <i class="uil uil-thumbs-up"></i>
                        <span class="link-name">Like</span>
                    </a></li>
                <li><a href="#">
                        <i class="uil uil-comments"></i>
                        <span class="link-name">Comment</span>
                    </a></li>
                <li><a href="#">
                        <i class="uil uil-share"></i>
                        <span class="link-name">Share</span>
                    </a></li>
            </ul>

            <ul class="logout-mode">
                <li><a href="#">
                        <i class="uil uil-signout"></i>
                        <span class="link-name">Logout</span>
                    </a></li>
                <li class="mode">
                    <a href="#">
                        <i class="uil uil-moon"></i>
                        <span class="link-name">Dark Mode</span>
                    </a>
                    <div class="mode-toggle">
                        <span class="switch"></span>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Search here...">
            </div>

            <!--<img src="images/profile.jpg" alt="">-->
        </div>

        <script>
            const body = document.querySelector("body"),
                modeToggle = body.querySelector(".mode-toggle");
            sidebar = body.querySelector("nav");
            sidebarToggle = body.querySelector(".sidebar-toggle");
            let getMode = localStorage.getItem("mode");
            if (getMode && getMode === "dark") {
                body.classList.toggle("dark");
            }
            let getStatus = localStorage.getItem("status");
            if (getStatus && getStatus === "close") {
                sidebar.classList.toggle("close");
            }
            modeToggle.addEventListener("click", () => {
                body.classList.toggle("dark");
                if (body.classList.contains("dark")) {
                    localStorage.setItem("mode", "dark");
                } else {
                    localStorage.setItem("mode", "light");
                }
            });
            sidebarToggle.addEventListener("click", () => {
                sidebar.classList.toggle("close");
                if (sidebar.classList.contains("close")) {
                    localStorage.setItem("status", "close");
                } else {
                    localStorage.setItem("status", "open");
                }
            })
        </script>
</body>

</html>
