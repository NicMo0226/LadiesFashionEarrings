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
    <?php
    include ("inc/nav.inc.php");
    ?>

    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-8 col-xl-8 col-md-8 col-lg-8 col-xl-8 col-md-offset-2">

                    <h1>Insert Product</h1>

                    <form method="post" id="form" enctype="multipart/form-data" action="mng_content.php">
                        <input type="hidden" name="action" value="insert" /><br />
                        <input type="text" name="product_name" placeholder="Name" /><br />
                        <input type="text" name="product_category" placeholder="Category" /><br />
                        <input type="text" name="product_price" placeholder="Price" /><br />
                        <textarea name="product_description" placeholder="Description"></textarea><br />
                        <input type="file" name="thumb_image" placeholder="Thumbnail" /><br />
                        <input type="file" name="product_image" placeholder="Main Image" /> <br />
                        <input type="submit" value="Insert Product" />
                    </form>

                </div>
            </div>
        </div>

    </body>
    <?php
    include ("inc/footer.inc.php");
    ?>

</html>