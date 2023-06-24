<?php
    error_reporting(0);
    require("database.php");
    
    $success = false;

    if(isset($_POST["register"])) {
        $uname = $_POST["uname"];
        $upass = hash("sha256",$_POST["upass"]);
        $uemail = hash("sha256",$_POST["uemail"]);

        $sql = "INSERT INTO user_reg(u_name,u_pass,u_email) VALUES('$uname','$upass','$uemail')";
        $res = mysqli_query($conn,$sql);
        $success = true;
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
    <header> <span id="brand-title">E-Commerce Website</span> </header>
    <div id="root">
        <div class="card user-reg">
            <div class="card-header text-muted">
                <span>Register!</span>
            </div>
            <form action="index.php" method="POST">
                <div class="card-body">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="uname" name="uname" placeholder="Enter your username">
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" id="uemail" name="uemail" placeholder="Enter your email address">
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" id="upass" name="upass" placeholder="Create a password">
                    </div>
                    <div class="mb-3 d-grid">
                        <input type="submit" value="Register" class="btn btn-primary" id="register" name="register">
                    </div>
                </div>
            </form>
            <?php
                if($success) {
                    echo "
                    <div class='alert alert-primary text-center' role='alert'>
                        <img src='images/success.ico' alt='success'> <span>Your account has been successfully created!</span>
                    </div>
                    ";
                }
            ?>
            <div class="card-footer text-center">
               If you already have an account try <a href="login.php">Login</a>
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