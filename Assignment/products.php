<?php
    error_reporting(0);
    require("database.php");

    $sql = "SELECT * FROM product_details";
    $res = mysqli_query($conn,$sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/index.css">
    <title>Products</title>
</head>
<body>
    <header>

    </header>
    <div id="root">
        <?php
            if(mysqli_num_rows($res) > 0) {
                while($row = mysqli_fetch_assoc($res)) {
                    
                    $uid = $row["u_id"];
                    $ptitle = $row["p_title"];
                    $pdesc = $row["p_desc"];
                    $pprice = $row["p_price"];
                    $pquantity = $row["p_quantity"];
                    $pimage = $row["p_image"];

                    $sql = "SELECT user_store.s_name FROM user_store WHERE u_id=$uid";
                    $res = mysqli_query($conn,$sql);
                    $row = mysqli_fetch_assoc($res);
                    $storename = $row["s_name"];

                    echo "
                    <div class='card product-info'>
                        <div class='card-header'>
                            <span id='product-name'>$storename</span>
                        </div>
                        <div class='card-body'>
                            <div class='mb-3'>
                                Product name: $ptitle
                            </div>
                            <div class='mb-3'>
                                Description: $pdesc
                            </div>
                            <div class='mb-3'>
                                Price: &#8377;$pprice
                            </div>
                            <div class='mb-3'>
                                Availability: $pquantity
                            </div>
                            <div class='mb-3 text-center'>
                                <img src='./media/$pimage' alt='$pimage' height='100px' width='100px'>
                            </div>
                        </div>
                    </div>
                    ";
                }
            } else {
                echo "0 Results";
            }
        ?>
    </div>
    <footer></footer>
    <script src="js/popper.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/index.js"></script>
</body>
</html>