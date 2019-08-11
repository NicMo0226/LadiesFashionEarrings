<?php
session_start(); //creates session
include("inc/dbconnect.inc.php");
//get searchterm from url / form submission
if(isset($_GET['searchterm'])) {
//check if we have a search term
$result = mysqli_query($dbconnect, 
		 "SELECT *
		 FROM `product`
		 WHERE `product_name`
		 LIKE '%{$_GET['searchterm']}%'"
		 );

} else if(isset($_GET['cat'])) {
//check if we have a search term
$result = mysqli_query($dbconnect, 
		 "SELECT *
		 FROM `product`
		 WHERE `product_category`= '{$_GET['cat']}'"
		);

} else {
	$result= mysqli_query ($dbconnect,
			"SELECT * 
			FROM `product`"
);
}
?>
<!doctype html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>
        <?php 
include ("inc/scriptpackage.inc.php");
 ?>
        <link rel="stylesheet" href="nav.css">
        <link rel="stylesheet" href="product.css">
        <link rel="stylesheet" href="footer.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Josefin+Slab">
        <script type="text/javascript">
        < script type = "text/javascript" >
            $(document).ready(function() {
                $("#searchterm").autocomplete({
                    source: "mng/mng_search.php",
                    minLength: 2,
                    select: function(event, ui) {
                        window.location = "detail.php?id=" + ui.item.id;
                    }
                });
            });
        </script>
    </head>
    <style>
    a {

        padding: none !important;
    }
    </style>

    <body>
        <?php 
include ("inc/nav.inc.php");
?>
        <?php
//loop through the results
while($row=mysqli_fetch_array($result)) {
	?>
        <div class="container-fluid">
            <div class="row" id=" prodrow">
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text-right">
                            <img class="prdimg" src="<?php echo $row['thumb_image'];?>" width="50%" alt="product-thumb">
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text-left">
                            <?php echo '<h4>' . $row['product_name'] . '</h4>'; ?>
                            <?php echo '<h5> &pound;'. $row['product_price'] . '</h5>'; ?>
                            <?php echo '<a class="more" href="detail.php?id=' . $row['product_id'] . '">';
     echo 'More Details</a>'; ?>
                        </div>
                    </div>
                </div>
                <?php 
	} //end while loop
?>
            </div>
        </div>
    </body>
    <?php 
include ("inc/footer.inc.php");
?>

</html>