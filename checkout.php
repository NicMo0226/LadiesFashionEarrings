<!doctype html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="checkout.css" rel="stylesheet" type="text/css">
  <link href="header.css" rel="stylesheet" type="text/css">
  <link href="footer.css" rel="stylesheet" type="text/css">
  <link href="contact.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Josefin+Slab" rel="stylesheet">
	</head>
<body>

<?php include 'inc/header.php' ?>
<!––1 row of 2 columns––>

<div class="container-fluid main">
  <div class="row">

     <!--REVIEW PURCHASE-->
    <div class=".col-12  col-sm-12  col-md-12 col-lg-6  col-xl-6" >
     <div class=".col-sm-12" id="section">
    <div class="prodimg">
       <img class="img-responsive" src="images/bracelet6.png" id=imgplace>
     </div>
   <div class="review">
      <h1>Review your Purchase</h1>
      <h2>Product <br/>Product Description<br/></h2>
      <h5>Product Quantity<br/>Product Price<br/></h5>
    </div>
    </div>
  </div>

  <!--DELIVERY ADDRESS-->
      <div class=".col-12  col-sm-12  col-md-12 col-lg-6  col-xl-6">
        <div class=".col-sm-12" id="section">
          <div class="address">
          <h1 id="Addtitle">Delivery Address Details</h1>
          <h5>Delivery Address<br/>Line 1<br/>Line 2<br/>Town<br/>County<br/>Postcode<br/>
          </h5>
        </div>

<div class="addressupdate">
<h5>Is this Correct</h5>
<label class="radio-inline"><input type="radio" name="optradio">Yes</label>
<label class="radio-inline"><input type="radio" name="optradio">No</label>
</div>
 <div class="form-group" >
  
  <textarea class="form-control" rows="5" placeholder="Update Address" id="updatefield"></textarea>
 
</div>
    </div>
      </div>
</div>
</div>
<!––1 row of 2 columns––>
<div class="container-fluid main">
  <div class="row">

     <!--INSTRUCTIONS-->
    <div class=".col-12  col-sm-12  col-md-12 col-lg-6  col-xl-6">
    <div class=".col-sm-12" id="section">
    </div>
  </div>

   <!--PAY-->
    <div class=".col-12  col-sm-12  col-md-12  col-lg-6  col-xl-6">
      <div class=".col-sm-12" id="section">
    </div>

   </div> 
  </div>
</div>
<?php include 'inc/footer.php' ?>
