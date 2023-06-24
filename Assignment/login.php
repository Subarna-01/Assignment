<?php
    error_reporting(0);
    require("database.php");

    $errorMsg = false;

    if(isset($_POST["login"])) {
        
        $upass = hash("sha256",$_POST["upass"]);
        $sql = "SELECT * FROM user_reg WHERE u_pass='$upass'";
        $res = mysqli_query($conn,$sql);
        $numRows = mysqli_num_rows($res);
        $user_info = mysqli_fetch_assoc($res);
        if($numRows == 1) {
            session_start();
            $_SESSION["userid"] = $user_info["u_id"];
            $_SESSION["username"] = $user_info["u_name"];
            header("location: seller.php");

        } else $errorMsg = true;
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
    <header><span id="brand-title">E-Commerce Website</span></header>
    <div id="root">
        <div class="card user-login">
            <div class="card-header text-muted">
                <span>Login</span>
            </div>
            <form action="login.php" method="POST">
                <div class="card-body">
                    <div class="mb-3">
                        <input type="password" class="form-control" id="upass" name="upass" placeholder="Password">
                    </div>
                    <div class="mb-3 d-grid">
                        <input type="submit" value="Login" class="btn btn-primary" id="login" name="login">
                    </div>
                </div>
            </form>
            <?php
                if($errorMsg){
                    echo "
                    <div class='alert alert-danger text-center' role='alert'>
                        Invalid password! Try login using <a href='elogin.php'> Email</a>
                    </div>
                    ";
                }
            ?>
            <div class="card-footer text-center">
                If you don't have an account try <a href="index.php">Register</a>
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