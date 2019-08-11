<!doctype>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <?php
    include ("inc/scriptpackage.inc.php");
    ?>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link href="index.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="footer.css">
    <script>
    var main = $('div.main');
    main.each(function() {
        var mar = $(this),
            indent = mar.width();
        mar.main = function() {
            indent--;
            mar.css('text-indent', indent);
            if (indent < -1 * mar.children('div.maintext').width()) {
                indent = mar.width();
            }
        };
        mar.data('interval', setInterval(mar.main, 1000 / 60));
    });
    </script>
</head>

<body>

    <?php include ("inc/nav.inc.php") ?>

    <!–– 1 row of 12 and 1 row of 3––>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 box">

                    <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="3000">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                            <li data-target="#myCarousel" data-slide-to="3"></li>
                            <li data-target="#myCarousel" data-slide-to="4"></li>
                            <li data-target="#myCarousel" data-slide-to="5"></li>
                            <li data-target="#myCarousel" data-slide-to="6"></li>
                            <li data-target="#myCarousel" data-slide-to="7"></li>
                            <li data-target="#myCarousel" data-slide-to="8"></li>
                            <li data-target="#myCarousel" data-slide-to="9"></li>
                        </ol>
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <img src="images/slider1.jpg" alt="jewellery">
                            </div>
                            <div class="item">
                                <img src="images/slider2.jpg" alt="jewellery">
                            </div>
                            <div class="item">
                                <img src="images/slider3.jpg" alt="jewellery">
                            </div>
                            <div class="item">
                                <img src="images/slider4.jpg" alt="jewellery">
                            </div>
                            <div class="item">
                                <img src="images/slider5.jpg" alt="jewellery">
                            </div>
                            <div class="item">
                                <img src="images/slider6.jpg" alt="jewellery">
                            </div>
                            <div class="item">
                                <img src="images/slider7.jpg" alt="jewellery">
                            </div>
                            <div class="item">
                                <img src="images/slider8.jpg" alt="jewellery">
                            </div>

                        </div>
                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel" role="button">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" role="button">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

                    <div class="main">
                        <p class="maintext">Sparkles and Shines provides gorgeous jewellery at affordable prices, and is guaranteed to
                            make
                            you
                            stand out from the crowd!! Click on a category to find your perfect product today.</p>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid box">
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-3 col-xl-3" id="catergory">

                    <a href="listing.php?cat=Ring"> <img class="img-responsive" id="first" src="images/ring10.jpg"></a>
                </div>
                <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <a href="listing.php?cat=Earrings"> <img class="img-responsive" id="first" src="images/home2.jpg"></a>
                </div>

                <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <a href="listing.php?cat=Bracelet"> <img class="img-responsive" id="first" src="images/home3.png"></a>
                </div>
                <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <a href="listing.php?cat=Necklace"> <img class="img-responsive" id="first" src="images/home4.jpg"></a>
                </div>

            </div>
        </div>


        <?php include 'inc/footer.inc.php' ?>