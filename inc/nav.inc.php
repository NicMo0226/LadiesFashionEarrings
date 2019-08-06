<?php
session_start(); //creates session
include("dbconnect.inc.php");
include("cartdisplay.inc.php");

//get searchterm from url / form submission
$navResults= mysqli_query ($dbconnect,
      "SELECT DISTINCT `product_category`
      FROM `product`"
);
?>
<style>
@charset "utf-8";

/* CSS Document */
body {
    background-color: #eaeaea !important;
    overflow-x: hidden;
    font-family: 'Josefin Slab', serif;
    font-size: 1.2em;
}

#top {
    background-color: #a79f9f;

}

#header {
    height: 5em;
    margin-bottom: 0;
    margin-top: 0;
    background-color: #a79f9f;
    padding-bottom: 0 !important;
    padding-top: 0 !important;
}

.navbar-light {
    background-color: #a79f9f;
    padding-bottom: 0 !important;
    margin-bottom: 0 !important;
}

#catimg {
    padding-top: .5em;
}

#myNavbar {
    font-family: 'Josefin Slab', serif;
    font-style: bold;
    font-size: 1.6em;
    text-align: center;
    color: #202020;

    padding-bottom: 0 !important;
    margin-bottom: 0 !important;
}

a {
    color: #202020;
    padding: 1em;
}

.size {
    padding-bottom: 0 !important;
}

.lilink {
    display: inline;
    text-decoration: none;
    border: 2px solid white;
    box-shadow: rgb(154, 47, 252) 10px 1px 10px;
    float: right;
    padding: .5em;
    margin: 1em;
}

.lilinks {
    text-align: center;
}

#search {
    position: absolute;
    display: inline-block;
    top: 1em;

}

.log {
    position: relative;
    font-family: 'Josefin Slab', serif;
    font-size: .8em;
    font-style: italic;
    font-weight: 700;
    float: right;

}

#logo {
    padding-top: 1em;
}


.form-inline {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-flow: row wrap;
    flex-flow: row wrap;
    -ms-flex-align: center;
    align-items: center;
}

#cart {

    display: inline-block;
    padding: 0;
    border: none;
    box-shadow: none;
    left: 0;
    position: relative;
    top: .2em;

}

#cartmessage {

    display: inline-block;
    margin: 0 auto;
    position: absolute;
    padding-top: .1em;
    font-size: 1.4em;
}

li {
    width: 7em;
}

#searches {
    width: 75%;

    margin-top: .2em;
}

#searchbt {
    width: 5em;
    margin-left: 0 !important;
    margin-top: .2em;
}

#topsec {
    padding-top: 1em;
}
</style>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<div class="container-fluid" id="top">

    <div class="row">
        <div class="col-sm-3  col-md-3 col-lg-3  col-xl-3">
            <img class="image-responsive" src="images/splash.png" width="120" id="logo">
        </div>
        <div class="col-sm-9">
            <div class="row">
                <div class="col-sm-3  col-md-3 col-lg-3  col-xl-3">
                    &nbsp;
                </div>
                <div class="col-sm-3  col-md-3 col-lg-3  col-xl-3">
                    <a href="register.php" class="log">Register</a>
                    <a href="register.php" class="log">Login</a>
                </div>

                <div class="col-sm-5  col-md-5 col-lg-5  col-xl-5">
                    <?php 
                    include ("search.inc.php");
                     ?>
                </div>
                <div class="col-sm-1  col-md-1 col-lg-1  col-xl-1">
                    <a id="cart" href="cart.php"><img src="images/cart.png" width="25"> </a>

                    <p id="cartmessage"><?php echo $count; ?><a href="cart.php"></a></p>
                    <span id="cartload"></span>
                </div>

            </div>
            <div class="row">
                <nav class="navbar navbar-light">
                    <ul id="items">
                        <li class="lilink"><a class="lilinks" href="index.php">Home</a>

                            <?php 
                                while($navRow=mysqli_fetch_array($navResults)) {
                                ?>
                        <li class="lilink text-center" id="items">
                            <a class="lilinks" href="listing.php?cat=<?php echo $navRow['product_category'];?>">
                                <?php echo $navRow['product_category']; 
                                ?>
                            </a>
                        </li>
                        <?php 
                                }
                            ?>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->