<?php $root = 'http://soccerfanhub.com/';//$root = 'http://localhost/soccerfanhub/'; ?>
<!doctype html>
<html class="error-page no-js" lang="">

<head>
    <!-- meta -->
    <meta charset="utf-8">
    <meta name="description" content="SoccerFanHub, World's Largest Soccer Club Fans Network">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
    <!-- /meta -->

    <title>Error Page | SoccerFanHub</title>
	<link rel="stylesheet" href="<?php echo $root; ?>bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $root; ?>css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo $root; ?>css/themify-icons.css">
    <link rel="stylesheet" href="<?php echo $root; ?>css/animate.min.css">
    <!-- /core styles -->

    <!-- template styles -->
    <link rel="stylesheet" href="<?php echo $root; ?>css/skins/palette.css">
    <link rel="stylesheet" href="<?php echo $root; ?>css/fonts/font.css">
    <link rel="stylesheet" href="<?php echo $root; ?>css/main.css">
    <!-- template styles -->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- load modernizer -->
    <script src="<?php echo $root; ?>plugins/modernizr.js"></script>
</head>

<body class="bg-primary">

    <!-- error wrapper -->
    <div class="center-wrapper">

        <div class="center-content text-center">

            <div class="error-number animated bounceIn">
            	<div style="font-size:xx-large;">
                	<img src="<?php echo $root.'img/logo.png'; ?>" alt="SFH"><br />
                    SoccerFanHub
                </div>
                <span class="text-muted">404</span>
            </div>

            <div class="mb25">PAGE NOT FOUND</div>

            <p>Sorry, but the page you were trying to view does not exist.</p>

            <!--<div class="search">
                <form class="form-inline" role="form">
                    <div class="search-form">
                        <button class="search-button" type="submit" title="Search">
                            <i class="ti-search"></i>
                        </button>
                        <input type="text" class="form-control no-b" placeholder="Search Admin Panel">
                    </div>
                </form>
            </div>-->

            <ul class="mt25 error-nav">
                <li>
                    <a href="<?php echo $root; ?>">&copy;
                        <span id="year" class="mr5"></span>SFH - SoccerFanHub</a>
                </li>
                <li>
                    <a href="<?php echo $root; ?>moots">Moots</a>
                </li>
                <li>
                    <a href="<?php echo $root; ?>clubs">Clubs</a>
                </li>
                <li>
                    <a href="<?php echo $root; ?>fans">Fans</a>
                </li>
                <li>
                    <a href="<?php echo $root; ?>facts">Facts</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- /error wrapper -->

    <script type="text/javascript">
        var el = document.getElementById("year"),
            year = (new Date().getFullYear());
        el.innerHTML = year;
    </script>
</body>
<!-- /body -->
</html>
