<?php
session_start(); //creates session
include("dbconnect.inc.php");
include("cartdisplay.inc.php");
include("header.inc.php");

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



#header {
    height: 5em;
    margin-bottom: 0;
    margin-top: 0;

    padding-bottom: 0 !important;
    padding-top: 0 !important;
}

#items {
    margin-top: .5em;
}

.navbar-light {
    background-color: #d3cecee5;
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
    border: 1px solid white;
    box-shadow: rgb(76, 0, 255) 5px 1px 5px;
    float: right;
    padding: .25em;
    margin: .25em;
}

.lilinks {
    text-align: center;
    font-size: .7em;
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

.icon {
    display: inline;
    text-decoration: none;
    float: right;
    position: relative;
    right: 23em;
    top: .5em;
}


a.home {
    left: 45em;
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
<link rel="stylesheet" href="header.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css?family=Roboto+Slab&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Josefin+Slab">
<div class="container-fluid" id="top">

    <div class="row">
        <div class="col-sm-3  col-md-3 col-lg-3  col-xl-3">
            <img class="image-responsive" src="images/splash.png" width="120" id="logo">
        </div>
        <div class="col-sm-9">
            <div class="row">
                <div class="col-sm-3  col-md-3 col-lg-3  col-xl-3">

                </div>
                <div class="col-sm-3  col-md-3 col-lg-3  col-xl-3">
                    <?php
                    session_start();
                    if(!isset($_SESSION['user_username']) && empty($_SESSION['user_username']))
                    {
                        echo '<a class="log" href="register.php"></a>Log In</a>';
                    }   
                    else 
                    {
                        echo  '<p class="welc">Welcome </p>', $_SESSION['user_username'] , '<a class="welc" href="log_out.php">Log Out</a>';
                    }
                    ?>

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
                        <li class="icon"><a class="home" href="index.php"><i class="material-icons">
                                    home
                                </i></a></li>

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

                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->