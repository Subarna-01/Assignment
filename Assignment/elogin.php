<?php
    error_reporting(0);
    use PHPMailer\PHPMailer\PHPMailer;
    require("database.php");
    require("phpmailer/src/Exception.php");
    require("phpmailer/src/PHPMailer.php");
    require("phpmailer/src/SMTP.php");

    $errorMsg = false;
    $otpErrorMsg = false;
    $otpStatus = false;

    if(isset($_POST["verify"])) {
        
        $uemail = hash("sha256",$_POST["uemail"]);
        $sql = "SELECT * FROM user_reg WHERE u_email='$uemail'";
        $res = mysqli_query($conn,$sql);
        $numRows = mysqli_num_rows($res);
        $user_info = mysqli_fetch_assoc($res);
        
        if($numRows == 1) {
            
            $otp = rand(100000,999999);

            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'subarnabhowmik1@gmail.com';
            $mail->Password = 'myixqpboembixcwl';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('subarnabhowmik1@gmail.com');
            $mail->addAddress($_POST["uemail"]);
            $mail->isHTML(true);
            $mail->Subject = 'Login Verification';
            $mail->Body = 'Your OTP verification code is '.$otp.' .Do not share this code with anyone.';

            if($mail->send()) {
                session_start();
                $_SESSION["otp"] = $otp;
                $_SESSION["userid"] = $user_info["u_id"];
                $_SESSION["username"] = $user_info["u_name"];
                $otpStatus = true;
            }
        } else $errorMsg = true;
    }
    if(isset($_POST["login"])) {
        if($_SESSION["otp"] == $_POST["uotp"]) {
            header("location: seller.php");
        } else {
            $otpErrorMsg = true;
        }
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
            <form action="elogin.php" method="POST">
                <div class="card-body">
                    <?php
                        if(!$otpStatus) {
                            echo "
                            <div class='mb-3'>
                                <input type='email' class='form-control' id='uemail' name='uemail' placeholder='Email address'>
                            </div>
                            <div class='mb-3 d-grid'>
                                <input type='submit' value='Verify' class='btn btn-primary' id='verify' name='verify'>
                            </div>
                            ";
                        } else {
                            echo "
                            <div class='mb-3'>
                                <input type='text' class='form-control' id='uotp' name='otp' placeholder='Enter the otp sent to you'>
                            </div>
                            <div class='mb-3 d-grid'>
                                <input type='submit' value='Login' class='btn btn-primary' id='login' name='login'>
                            </div>
                            <div class='alert alert-primary text-center' role='alert'>
                                An otp has been sent to your email address.
                            </div>
                            ";
                        }
                    ?>
                </div>
            </form>
            <?php
                if($errorMsg){
                    echo "
                    <div class='alert alert-danger text-center' role='alert'>
                        Invalid email address! Try login using <a href='login.php'> Password</a>
                    </div>
                    ";
                }
                if($otpErrorMsg){
                    echo "
                    <div class='alert alert-danger text-center' role='alert'>
                        You have entered wrong OTP!
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