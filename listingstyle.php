<?php

//connect to database
include("inc/dbconnect.inc.php");
//get searchterm from url / form submission

$searchterm = $_GET['searchterm'];
//check if we have a search term

if($searchterm != "") {
//search query
	$query = "SELECT *
		 FROM `product`
		 WHERE `product_name` 
		 LIKE '%{$searchterm}%'";
} 
else {
//construct query
$query = "SELECT *
		 FROM `product`";
}
$results = mysqli_query($dbconnect, $query); 
echo mysqli_error($dbconnect);

echo '<p>' . $row['product_id'] . '</p>';
	echo '<p>' . $row['product_name'] . '</p>';
	echo '<p>' . $row['product_price'] . '</p>';
	echo '<p>' . $row['product_description'] . '</p>';
?>

<!DOCTYPE>
<html>

    <head>
        <meta charset="utf-8">
        <title>Untitled Document</title>
        <?php 
include ("inc/scriptpackage.inc.php");
 ?>
    </head>

    <body>

        <h1>Products</h1>
        <?php
//loop through the results
while($row=mysqli_fetch_array($results)) {
?>

        <a href="#">
            <?php echo $row ['product_name']; ?>
        </a>

        <?php

while($row=mysqli_fetch_array($results)) {

?>
    </body>

</html>