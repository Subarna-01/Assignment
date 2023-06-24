<?php
    // error_reporting(0);
    session_start();
    require("database.php");

    $ssuccess = false;
    $psuccess = false;

    if(isset($_POST["screate"])) {

        $userid = $_SESSION["userid"];
        $storename = $_POST["sname"];
        $storedesc = $_POST["sdesc"];
        $usercontact = $_POST["ucontact"];

        $sql = "INSERT INTO user_store(u_id,s_name,s_desc,u_contact) VALUES($userid,'$storename','$storedesc','$usercontact')";
        $res = mysqli_query($conn,$sql);
        $ssuccess = true;
    }

    if(isset($_POST["padd"])) {

        $userid = $_SESSION["userid"];
        $producttitle = $_POST["ptitle"];
        $productdesc = $_POST["pdesc"];
        $productprice = (int)$_POST["pprice"];
        $productquantity = (int)$_POST["pqtn"];
        $productimage = $_FILES["pimage"]["name"];

        $sql = "INSERT INTO product_details(u_id,p_title,p_desc,p_price,p_quantity,p_image) VALUES($userid,'$producttitle','$productdesc','$productprice','$productquantity','$productimage')";
        $res = mysqli_query($conn,$sql);

        move_uploaded_file($_FILES["pimage"]["tmp_name"],"./media/".$_FILES["pimage"]["name"]);


        $psuccess = true;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/index.css">
    <title>E-Commerce</title>
</head>
<body>
    <header><span id="user">Welcome <?php echo $_SESSION["username"]?></span></header>
    <div id="root">
        <div class="card create-store">
            <div class="card-header text-muted">
                <span>Hey seller! create your store.</span>
            </div>
            <form action="seller.php" method="POST">
                <div class="card-body">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="sname" name="sname" placeholder="Store name">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="sdesc" name="sdesc" placeholder="Store description">
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" id="ucontact" name="ucontact" placeholder="Contact info(email address)">
                    </div>
                    <div class="mb-3 d-grid">
                        <input type="submit" value="&#65291; Create store" class="btn btn-primary" id="screate" name="screate">
                    </div>
                </div>
            </form>
            <?php
                if($ssuccess) {
                    echo "
                    <div class='alert alert-primary text-center' role='alert'>
                        <img src='images/success.ico' alt='success'><span>Congratulations on creating a store!</span>
                    </div>
                    ";
                }
            ?>
        </div>
        <div class="card add-prod">
            <div class="card-header">
                <span class="text-muted">Add your products.</span>
            </div>
            <div class="card-body">
                <form action="seller.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <input type="text" name="ptitle" class="form-control" id="ptitle" placeholder="Product title">                        
                    </div>
                    <div class="mb-3">
                        <input type="text" name="pdesc" class="form-control" id="pdesc" placeholder="Product description">                        
                    </div>
                    <div class="mb-3">
                        <input type="text" name="pprice" class="form-control" id="pprice" placeholder="Product price">                        
                    </div>
                    <div class="mb-3">
                        <input type="text" name="pqtn" class="form-control" id="pqtn" placeholder="Product quantity">                        
                    </div>
                    <div class="mb-3">
                        <label for="pimage" class="text-muted">Add an image to your product</label>
                        <input type="file" name="pimage" class="form-control" id="pimage">                        
                    </div>
                    <div class="mb-3 d-grid">
                        <input type="submit" value="&#65291; Add product" name="padd" class="btn btn-primary" id="padd">
                    </div>
                </form>
                <?php
                    if($psuccess) {
                        echo "
                        <div class='alert alert-primary text-center' role='alert'>
                            <img src='images/success.ico' alt='success'><span>Product has been added!</span>
                        </div>
                        ";
                    }
                ?>
            </div>
        </div>
    </div>
    <footer></footer>
    <script src="js/popper.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/index.js"></script>
</body>
</html>