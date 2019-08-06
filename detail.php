<?php
session_start(); //creates session
include('inc/dbconnect.inc.php');
//get searchterm from url / form submission


     if (isset($_GET['id']) && is_numeric($_GET['id']))
    {
        $id = $_GET['id'];
    }

//check if we have a search term


// run query on database			
	$result = mysqli_query($dbconnect, 
	 "SELECT *
		 FROM `product`
		 WHERE `product_id` = {$id}"
		);
	
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

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="index.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="nav.css">
        <link rel="stylesheet" href="nav.css">
        <link rel="stylesheet" href="product.css">
        <link rel="stylesheet" href="footer.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Josefin+Slab">
        <style>
        body {
            background-color: white !important;
            overflow-x: hidden;
            font-family: 'Josefin Slab', serif;
            font-size: 3em;
        }

        #myCarousel {
            min-width: 100%;
        }

        h2,
        h3 {
            font-family: 'Josefin Slab', serif;
        }

        .carousel-inner {
            min-width: 100%;
            padding-top: 0 !important;
            margin-top: 0 !important;
        }

        .item {
            min-width: 100%;

            padding-left: 0 !important;
            padding-right: 0 !important;
            padding-top: 0 !important;
        }

        #first {
            height: 18em;
            background-color: white;
            min-width: 100%;
            padding-left: 0 !important;
            padding-right: 0 !important;
            margin-left: 0% !important;
            margin-right: 0% !important;
        }

        .container,
        #text {
            margin: 0 auto;
        }

        .seperate {

            border-bottom: 1px solid grey;
        }

        .prodimage {
            float: right;
        }

        p {
            padding-top: 0 !important;
            margin-left: 0 !important;
        }

        .prodcont {
            margin-top: 3em;
            margin-bottom: 1em;
        }

        #list {
            padding-top: 3em;
            margin-bottom: 1em;
        }
        </style>

        <script type="text/javascript">
        $(document).ready(function() {
            $('#addtocartlink').click(function() {
                //random generated number to make each AJAX call appear unique
                var randNum = Math.floor(Math.random() * 1000000000);

                $.ajax({
                    url: "mng_cart.php?rand=" + randNum,
                    dataType: 'text',
                    type: 'POST',
                    data: 'action=add&product_id=' +
                        $('#addtocartlink').attr('alt'),
                    beforeSend: function() {
                        $('#cartload').html('Loading...');
                    },
                    complete: function() {
                        $('#cartload').html('');
                    },
                    success: function(result) {
                        $("#holdcart").html('').append(result);
                    }
                });
                return false; //stops the link clicking normally
            });
        });
        </script>
    </head>

    <body>
        <?php 
include ("inc/nav.inc.php");
?>
        <?php 
//loop through the results
while($row=mysqli_fetch_array($result)) {

?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-8 col-xl-8 col-md-8 col-lg-8 col-xl-8 col-md-offset-2 prodcont">
                    <div class="row">
                        <div class="col-sm-4 col-xl-4 col-md-4 col-lg-4 col-xl-4 ">
                            <img class="prodimage" src="<?php echo $row['product_image'];?>" width="200" alt="product-thumb"><br />
                        </div>
                        <div class="col-sm-8 col-xl-8 col-md-8 col-lg-8 col-xl-8 ">
                            <h2> <?php echo $row ['product_name']; ?></a><br><br>
                                <h2>£ <?php echo  $row ['product_price']; ?></h2>
                                <a href="cart.php" id="addtocartlink" alt="<?php echo $row ['product_id']; ?>">Add to Cart</a>
                                <?php    
} // end while loop
?>
                        </div>


                    </div>
                </div>
            </div>
        </div>


        <?php 
include ("inc/footer.inc.php");
?>

</html>