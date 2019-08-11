<?php session_start();
include ("inc/dbconnect.inc.php");


if($_POST['stage']=="1") {
	
	$valid="true";//validation flag
	
	foreach($_POST as $key=>$value) {//loop through post array
		if($value==""){
			$valid="false";
			
		}
	}
	if(!$valid) {
    
		
		$_SESSION['message']="Please enter all details";
		header("location: checkout1.php");
	} else {
		
		$customerInsert = mysqli_query($dbconnect,
			"INSERT INTO `customer`
			(`user_id`,`cu_fname`,`cu_sname`, `cu_phone`, `cu_email`)
			VALUES
			({$_SESSION['user_id']},
			'{$_POST['fname']}',
			'{$_POST['sname']}',
			'{$_POST['phone']}',
			'{$_POST['email']}')"				 
		);
		if(!$customerInsert){
			$_SESSION['message']="Problem entering customer";
			header("location: checkout1.php");	
		} else {
			
	$_SESSION['cu_id']=mysqli_insert_id($dbconnect); //gets new id
		
			$addressInsert = mysqli_query($dbconnect,
				"INSERT INTO `address`(`cu_id`,`address_line1`,
				`address_line2`,`address_town`, `address_county`,`address_postcode`)
				VALUES
				({$_SESSION['cu_id']},
				'{$_POST['line1']}',
				'{$_POST['line2']}',
				'{$_POST['town']}',
				'{$_POST['county']}',
				'{$_POST['pcode']}')" 
				);
			if(!$addressInsert){
				$_SESSION['message']="Problem entering address";
				header("location: checkout1.php");
			}	else {
				$_SESSION['message']="Details successful";
$_SESSION['address_id']=mysqli_insert_id($dbconnect);
	header("location: checkout3.php");
			}
		}
	}
}	else if($_GET['stage']=="3") {
	//set up for transaction
	mysqli_query($dbconnect, "SET autocommit=0");
	mysqli_query($dbconnect, "START TRANSACTION");
	//insert query for sale (header)
	$saleInsert = @mysqli_query($dbconnect,
								"INSERT INTO `sale`
								(`cu_id`,`sale_date`,
								`sale_total`)
								VALUES
								({$_SESSION['cu_id']},
								NOW(),{$_POST['total']})"
								);


if($saleInsert){
		
		//get sale id
		$saleid = mysqli_insert_id($dbconnect);
		
		//loop through post array (sale rows)
		foreach($_POST as $key=>$value) {
			if(stristr($key,'pid'))
				$productid = $value; //gets id
			if(stristr($key,'qty'))
				$qty = $value;		//gets qty
			if(stristr($key,'net'))
				$net = $value;		//gets net total
			
			if($productid && $qty && $net){
				//insert SALE_ROW row
				$rowInsert = @mysqli_query ($dbconnect,
						"INSERT INTO `sale_row`
									(`sale_id`,`product_id`,
									`sr_qty`,
									`sr_net`)		  
						VALUES
						({$saleid},{$productid},{$qty},{$net})"
						   );
				
						   
				//clear values for new row if required
				$productid=""; $qty=""; $net="";
				
				//if row is not inserted
				if(!$rowInsert) {
					$rowRollback=true; //set roll back flag
					
				}//row insert check
			}//row details check
		}//POST array check (loop)
		
		if(!$rowRollback){
			//commits transaction if all gone through
			mysqli_query($dbconnect,"COMMIT");
			$_SESSION['message']="Your order has been confirmed.";
			header("location: orderconfirmed.php");
			
		} else {
			//rolls back transaction if issues
			mysqli_query($dbconnect,"ROLLBACK");
			$_SESSION['message']="There has been a problem with your order details.";
			header("location: checkout3.php");
			
		}
		
	} else {
		//rolls back transaction if issues
			mysqli_query($dbconnect,"ROLLBACK");
			$_SESSION['message']="There has been a problem with your order.";
			("location: checkout3.php");
			
	}//sale insert check
}//checkout stage 3 