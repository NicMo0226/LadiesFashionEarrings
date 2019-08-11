<?php
include("inc/dbconnect.inc.php");

$results = mysqi_query ($dbconnect, 
"SELECT *
FROM `product`
WHERE `product_name` LIKE '%{$_GET['term']}%'"
);

$mainarray = array(); //main container for listings

while($row=mysqli_fetch_array($results)) {

	$rowarray=array (
		"id" => $row['product_id'],
		"label" => $row ['product_name']
	
	); //create indivisual row
array_push ($mainarray,$rowarray); //add row to main listing
}

echo json_encode ($mainarray);
