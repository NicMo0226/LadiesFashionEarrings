<!doctype>
<html>

    <head>
        <meta charset="utf-8">
        <title>Untitled Document</title>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <link href="index.css" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="header.css">
        <link rel="stylesheet" href="footer.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Josefin+Slab">
        <?php 
include ("inc/scriptpackage.inc.php");
 ?>
    </head>
    <style>
    body {
        background-color: #fff7e5 !important;
    }

    h1 {
        margin: 0 auto;
        text-align: center;
        padding-top: 2em;

    }

    #form {
        margin: 0 auto;
        width: 20em;
    }
    </style>

    <body>

        <h1>Insert Product</h1>

        <form method="post" id="form" enctype="multipart/form-data" action="mng_content.php">
            <input type="hidden" name="action" value="insert" /><br />
            <input type="text" name="p_name" placeholder="Name" /><br />
            <input type="text" name="p_category" placeholder="Category" /><br />
            <input type="text" name="p_price" placeholder="Price" /><br />
            <textarea name="p_desc" placeholder="Description"></textarea><br />
            <input type="file" name="thumb" placeholder="Thumbnail" /><br />
            <input type="file" name="main" placeholder="Main Image" /> <br />
            <input type="submit" value="Insert Product" />
        </form>
    </body>

</html>