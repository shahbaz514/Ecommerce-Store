<?php
include "db/db.php";
$site = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM athentication WHERE id = '1'"));

?>
<!DOCTYPE html>
<html lang="zxx">

<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>
        <?php echo $site['site_name']; ?>
    </title>


    <link rel="stylesheet" href="css/bootstrap1.min.css" />

    <link rel="stylesheet" href="vendors/themefy_icon/themify-icons.css" />
    <link rel="stylesheet" href="vendors/font_awesome/css/all.min.css" />


    <link rel="stylesheet" href="vendors/scroll/scrollable.css" />

    <link rel="stylesheet" href="css/metisMenu.css">

    <link rel="stylesheet" href="css/style1.css" />
    <link rel="stylesheet" href="css/colors/default.css" id="colorSkinCSS">
</head>
<body class="crm_body_bg">



<div class="main_content_iner" style="padding: 20px;">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <div class="white_box mb_30" style="background: #f3f6f9!important;">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="modal-content cs_modal">
                                <div class="modal-header theme_bg_1" style="background: #1d2c48!important;">
                                    <img src="img/site/<?php echo $site['site_logo']; ?>" style="text-align: left!important;">
                                    <h5 class="modal-title text_white"> Register Now</h5>
                                </div>
                                <div class="modal-body">
                                    <form action="register.php" method="post" enctype="multipart/form-data">
                                        <div class>
                                            <input type="text" name="name" class="form-control" placeholder="Enter your Name" required>
                                        </div>
                                        <div class>
                                            <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                                        </div>
                                        <div class>
                                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                                        </div>
                                        <button type="submit" name="register" class="btn_3 full_width text-center" style="width: 100%!important;">Register Now</button>
                                        <p>
                                            Already have an account?
                                            <a data-toggle="modal" data-target="#sing_up" data-dismiss="modal" href="login.php">
                                                Login Now
                                            </a>
                                        </p>
                                        <div class="text-center">
                                            <a href="forget.php" data-toggle="modal" data-target="#forgot_password" data-dismiss="modal" class="pass_forget_btn">
                                                Forget Password?
                                            </a>
                                        </div>
                                    </form>
                                    <?php
                                    if (isset($_POST['register']))
                                    {
                                        $name = mysqli_real_escape_string($db, $_POST['name']);
                                        $email = mysqli_real_escape_string($db, $_POST['email']);
                                        $password = mysqli_real_escape_string($db, $_POST['password']);
                                        $count = 0;
                                        $count = mysqli_num_rows(mysqli_query($db, "SELECT * FROM users WHERE email = '$email'"));


                                        if ($name == "" && $email == "" && $password == "")
                                        {
                                            ?>
                                            <div class="alert text-white bg-warning d-flex align-items-center justify-content-between" style="margin-top: 20px; background: #BA704F!important;" role="alert">
                                                <div class="alert-text">
                                                    Please Fill the Name, Email and Password Fields First!
                                                </div>
                                                <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                                                    <i class="ti-close text-white f_s_14"></i>
                                                </button>
                                            </div>
                                            <?php
                                        }
                                        else if ($count>0)
                                        {
                                            ?>
                                            <div class="alert text-white bg-warning d-flex align-items-center justify-content-between" style="margin-top: 20px; background: #BA704F!important;" role="alert">
                                                <div class="alert-text">
                                                    Your Email Already Exist, Try New One. Or Reset the Password.
                                                </div>
                                                <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                                                    <i class="ti-close text-white f_s_14"></i>
                                                </button>
                                            </div>
                                            <?php
                                        }
                                        else
                                        {
                                            $sql = mysqli_query($db, "INSERT INTO `users`(`name`, `email`, `password`, `role`, `status`) VALUES ('$name', '$email', '$password', 'User', 'UnVerified')");
                                            if ($sql)
                                            {
                                                $to = $_POST['email'];

                                                $subject = "Account Verification/Confirmation for ".$site['site_name'];

                                                $headers  = "From: " . strip_tags($_POST['req-email']) . "\r\n";
                                                $headers = "MIME-Version: 1.0\r\n";
                                                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

                                                $message = "<strong>Kindly verify your Email By </strong><a href='https://eshopup.hotmetallogos.com/login.php?verify=".$_POST['email']."'>Clicking Here</a>";


                                                $mail = mail($to, $subject, $message, $headers);

                                                if ($mail){
                                                    ?>
                                                    <div class="alert text-white bg-success d-flex align-items-center justify-content-between" style="margin-top: 20px; background: #BA704F!important;" role="alert">
                                                        <div class="alert-text">
                                                            <strong>Hi <?php echo $_POST['email']; ?>!</strong>
                                                            Your Registration is Completed! Kindly verify your Email Account. Kindly also check Your Spam Folder.
                                                            <center>
                                                                <a href="login.php" class="btn_3" style="margin-top: 20px;">
                                                                    Go To Login Page <i class="fas fa-home"></i>
                                                                </a>
                                                            </center>
                                                        </div>
                                                        <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                                                            <i class="ti-close text-white f_s_14"></i>
                                                        </button>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            else
                                            {
                                                ?>
                                                <div class="alert text-white bg-warning d-flex align-items-center justify-content-between" style="margin-top: 20px; background: #BA704F!important;" role="alert">
                                                    <div class="alert-text">
                                                        <strong>Hi <?php echo $_POST['email']; ?>!</strong>
                                                        Take an Error! Try Again.
                                                    </div>
                                                    <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                                                        <i class="ti-close text-white f_s_14"></i>
                                                    </button>
                                                </div>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12" style="margin-top: 20px;">
                            <p class="text-center">
                                &copy; 2023 Designed with
                                <i class="ti-heart" style="color: red;"></i>
                                . All Rights Reserved by
                                <a href="#" class="link-primary" target="_blank">
                                    <?php
                                    echo $site['site_name'];
                                    ?>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-1"></div>
        </div>
    </div>
</div>



<script src="js/jquery1-3.4.1.min.js"></script>

<script src="js/popper1.min.js"></script>

<script src="js/bootstrap1.min.js"></script>

<script src="js/metisMenu.js"></script>

<script src="vendors/scroll/perfect-scrollbar.min.js"></script>
<script src="vendors/scroll/scrollable-custom.js"></script>

<script src="js/custom.js"></script>
</body>

<!-- Mirrored from demo.dashboardpack.com/user-management-html/login.php by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 17 Nov 2023 15:31:05 GMT -->
</html>