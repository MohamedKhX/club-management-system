<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Transfer Arena</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" href="images/favicon.png">
    <link rel="shortcut icon" href="images/favicon.ico">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="css/feather.css">
    <link rel="stylesheet" href="css/nice-select2.css">
    <link href="css/jarallax.min.css" rel="stylesheet">
    <link href="css/venobox.min.css" rel="stylesheet">
    <!-- Style css -->
    <link rel="stylesheet" href="css/swiper-bundle.min.css">
    <link rel="stylesheet" href="css/style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Rubik';
        }
    </style>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
    <body>
        <!-- Preloader -->
        <div id="preloader">
            <div class="preloader">
                <span></span>
                <span></span>
            </div>
        </div>

        <!-- Header Start -->
        <header class="header header-4">
            <!-- Navigation Menu Start -->
            <nav class="navbar navbar-expand-lg bg-dark">
                <div class="container px-lg-0">
                    <a class="navbar-brand" href="index.html"><img src="images/logo-gradient.png" alt="Logo"></a>
                    <button class="navbar-toggler offcanvas-nav-btn" type="button">
                        <span class="feather-icon icon-menu"></span>
                    </button>
                    <div class="nav-cta order-lg-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <a href="login.html"><i class="feather-icon icon-user"></i></a>
                        </div>
                    </div>
                    <div class="offcanvas bg-dark offcanvas-start offcanvas-nav">
                        <div class="offcanvas-header">
                            <a href="index.html" class="text-inverse"><img src="images/logo-gradient.png" alt="Logo"></a>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>

                    </div>
                </div>
            </nav>
        </header>
        <!-- Header End -->

        <div>
            {{ $slot }}
        </div>

        <!-- Back to top -->
        <div class="back-top"><i class="feather-icon icon-chevron-up"></i></div>

        <!--Javascript
        ========================================================-->
        <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/swiper-bundle.min.js"></script>
        <script src="js/jarallax.min.js"></script>
        <script src="js/nice-select2.js"></script>
        <script src="js/venobox.min.js"></script>
        <script src="js/purecounter_vanilla.js"></script>
        <script src="js/isotope.pkgd.min.js"></script>

        <script src="js/custom.js"></script>

        <script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015" integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ==" data-cf-beacon='{"rayId":"8e979a47bef5e22d","version":"2024.10.5","r":1,"serverTiming":{"name":{"cfExtPri":true,"cfL4":true,"cfSpeedBrain":true,"cfCacheStatus":true}},"token":"389fa74406c44f21b129709ce8a3ec16","b":1}' crossorigin="anonymous"></script>
    </body>
</html>
