<?php
session_start();
session_abort();
include "db/db.php";
if (isset($_SESSION['username']))
{
    header("Location: index.php");
}
$site = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM athentication WHERE id = '1'"));

?>

<!DOCTYPE html>
<html lang="zxx">

<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>
        <?php
        echo $site['site_name'];
        ?>
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
                                    <h5 class="modal-title text_white"> Forget Password</h5>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post" enctype="multipart/form-data">                                        <div class>
                                            <input type="email" name="email" class="form-control" placeholder="Enter your email">
                                        </div>
                                        <button type="submit" name="forgetPassword" class="btn_3 full_width text-center" style="width: 100%!important;">
                                            Forget Password
                                        </button>
                                        <p>
                                            Need an account?
                                            <a data-toggle="modal" data-target="#sing_up" data-dismiss="modal" href="register.php">
                                                Sign Up
                                            </a>
                                        </p>
                                    </form>

                                    <?php
                                    if (isset($_POST['forgetPassword']))
                                    {
                                        $pass = rand();
                                        $sqlUp = mysqli_query($db, "UPDATE users SET password = '$pass' WHERE email = '".$_POST['email']."'");
                                        if ($sqlUp)
                                        {
                                            $msg = "Your New Password is " . $pass;
                                            $mail = mail($_POST['email'], "New Password For Eshop Upwork", $msg);
                                            if ($mail)
                                            {
                                                echo "<script>alert('Your Password is send on your registered Email. Kindly check also Spam Folder.')</script>";
                                                echo "<script>window.open('login.php','_self')</script>";
                                            }
                                            else
                                            {
                                                echo "<script>alert('Take an Error! Try Again.')</script>";
                                                echo "<script>window.open('register.php','_self')</script>";
                                            }
                                        }

                                    }
                                    ?>
                                </div>
                            </div>
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