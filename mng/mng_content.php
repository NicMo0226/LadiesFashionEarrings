<?php
session_start();

include("dbconnect.inc.php");

 if($_POST['action']=="insert") {
	
	 define ("MAX_SIZE", 20971520);
	  $errors=0;
	 
	 //filenames
	 $main = $_FILES['main'] ['name'];
	 $thumb = $_FILES['thumb'] ['name'];
	 // temp files
	 $upMain = $main = $_FILES['main'] ['tmp_name'];
	 $upThumb = $main = $_FILES['thumb'] ['tmp_name'];
	 
	 // images extension check 
	 $mainFile =stripslashes($main);
	 $mainExt = strtolower(getExtension("$mainFile"));
	 
	 $thumbFile =stripslashes($thumb);
	 $thumbExt = strtolower(getExtension("$thumbFile"));
	 
	 
	 if(!validExtension($mainExt) || !validEXtension($thumbExt)){
		$_SESSION['message'] ="Unknown image extension"; 
		 $errors=1;
	 } else {
		 //files sizes
		 $mainSize = filesize($upMain);
		 $thumbSize = filesize($upThumb);
		 
		 if($mainSize>MAX_SIZE || $thumbSize>MAX_SIZE){
				$_SESSION['message'] ="Upload a smaller File!"; 
		 $errors=1;	 
		 } else {
			 // filetype checks for memory images
			 switch($mainExt){
				 case "jpg" : $mainSrc = 
					 imagecreatefromjpeg($upMain); break;
					  case "jpeg" : $mainSrc = 
					 imagecreatefromjpeg($upMain); break;
					  case "png" : $mainSrc = 
					 imagecreatefrompng($upMain); break;
					  case "gif" : $mainSrc = 
					 imagecreatefromgif($upMain); break;
			 } 
			 switch($thumbExt){
				 case "jpg" : $thumbSrc = 
					 imagecreatefromjpeg($upThumb); break;
					  case "jpeg" : $thumbSrc = 
					 imagecreatefromjpeg($upThumb); break;
					  case "png" : $thumbSrc = 
					 imagecreatefrompng($upThumb); break;
					  case "gif" : $thumbSrc = 
					 imagecreatefromgif($upThumb); break;
			 }
			 //get uploaded width and height
			 list($mainWidth,$mainHeight) =getimagesize($upMain);
			 list($thumbWidth,$thumbHeight) =getimagesize($upThumb);
			 //main width 
			 $mainNewWidth = 250; 
			 $mainNewHeight =($mainHeight/$mainWidth) *$mainNewWidth;
			 $tmpMain = imagecreatetruecolor($mainNewWidth,$mainNewHeight);
			 
			 //thumb width
			 $thumbNewWidth = 100; 
			 $thumbNewHeight =($thumbHeight/$thumbWidth) *$thumbNewWidth;
			 $tmpThumb = imagecreatetruecolor($thumbNewWidth,$thumbNewHeight);
			 imagecopyresampled ($tmpMain,$thumbSrc,
			 				0,0,0,0,
			 				$mainNewWidth, $mainNewHeight,
			 				$mainWidth, $mainHeight);
			 imagecopyresampled ($tmpThumb,$mainSrc,
			 				0,0,0,0,
			 				$thumbNewWidth, $thumbNewHeight,
			 				$thumbWidth, $thumbHeight);
			 //create and save the images
			 switch ($mainExt) {
			 	case "jpg":
			 		imagejpeg($tmpMain, "images/main" . $main, 100);
			 		break;
			 	case"jpeg":	
			 		imagejpeg($tmpMain, "images/main" . $main, 100);
			 		break;
			 	case"png":	
			 		imagepng($tmpMain, "images/main" . $main, 0);
			 		break;
			 	case"gif":	
			 		imagegif($tmpMain, "images/main" . $main);
			 		break;
			 	
			 
			 }
			 	 switch ($thumbExt) {
			 	case "jpg":
			 		imagejpeg($tmpThumb, "images/thumb" . $thumb, 100);
			 		break;
			 	case"jpeg":	
			 		imagejpeg($tmpThumb, "images/thumb" . $thumb, 100);
			 		break;
			 	case"png":	
			 		imagepng($tmpThumb, "images/thumb" . $thumb, 0);
			 		break;
			 	case"gif":	
			 		imagegif($tmpThumb, "images/thumb" . $thumb);
			 		break;
			 	}
			 	//free up memory
			imagedestroy($mainSrc); imagedestroy($tmpMain);
			imagedestroy($humbSrc); imagedestroy($tmpThumb); 	
		 } //end files size check
		 
	 } //end extension check
	 if (!$errors) {  //sanitise before entry
	 	$product_name = mysqli_escape_string($dbconnect,
	 					$_POST['product_name']);
	 	$category_name = mysqli_escape_string($dbconnect,
	 					$_POST['product_category']);
	 	$product_price = mysqli_escape_string($dbconnect,
	 					$_POST['product_price']);
	 		$product_description = nl2br( mysqli_escape_string($dbconnect,
	 					$_POST['product_description'])); 
	 		$main ="images/main" . $main;
	 		$thumb ="images/thumb" . $thumb;
	 		//insert query
	 	$insertSql = "INSERT INTO `product`
	 				(`product_name`, `product_category`, `product_price`
	 				, `product_description`, `thumb_image`, `product_image` )
	 				VALUES 
	 				('{$product_name}','{$category_name}','{$product_price}','{$product_description}','{$thumb_image}','{$product_image}')";
	 				$insertResult = mysqli_query($dbconnect,$insertSql);
	 				if ($insertResult) {
	 					header("location: detail.php?id=" . 
	 					mysqli_insert_id($dbconnect));
	 				} else {
	 					$_SESSION['message']="Insertion failed";
	 					header("location: admin.php");
	 				}
	 }
 } //end insert

function validExtension($ext){
	if($ext == "jpg" || $ext == "jpeg"|| 
	  	$ext == "png" || $ext == "gif") {
		return true;
	} else {
		return false;
	}
}

function getExtension($str){
	// check for dot in string
	$i = strrpos($str,".");
	//if no dot return nothing
	if (!$i) {return ""; }
	//whats the extension based on length of string
	$l =strlen($str) - $i;
	//get extension using substring
	$ext =substr($str,$i+1,$l);
	//return extension
	return $ext;
}

?>