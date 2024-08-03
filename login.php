<?php
ob_start();
session_start();
include "db/db.php";
$error = "";
$site = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM athentication WHERE id = '1'"));
if (isset($_SESSION['email']))
{
    echo "<script>window.open('index.php','_self')</script>";
}
if (isset($_GET['verify']))
{
    $id = $_GET['verify'];
    $update = mysqli_query($db, "UPDATE users SET status = 'Active' WHERE email = '$id'");
    if ($update)
    {
        $error = '
        <div class="alert text-white bg-primary d-flex align-items-center justify-content-between" style="margin-top: 20px; background: #BA704F!important;" role="alert">
            <div class="alert-text">
                <strong>Hi '.$_GET["verify"].'!</strong>
                Account Verified. Login Now
            </div>
        </div>
        ';
    }
}
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
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</head>
<body class="crm_body_bg">



<div class="main_content_iner" style="padding: 20px;">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <div class="white_box_50px mb_30" style="padding: 20px; margin: 20px;">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="modal-content cs_modal">
                                <div class="modal-header theme_bg_1" style="background: #1d2c48!important;">
                                    <img src="img/site/<?php echo $site['site_logo']; ?>" style="text-align: left!important;">
                                    <h5 class="modal-title text_white"> Log in</h5>
                                </div>
                                <div class="modal-body">
                                    <?php
                                        echo @$error;
                                    ?>
                                    <form action="login.php" method="post" enctype="multipart/form-data">
                                        <div class>
                                            <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                                        </div>
                                        <div class>
                                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                                        </div>
                                        <div class="form-group">
                                            <!-- Google reCAPTCHA block -->
                                            <div class="g-recaptcha" data-sitekey="6Lc9nxkpAAAAAB2VbAbfvHtZ__3XMZGQkQktyLzJ"></div>
                                        </div>
                                        <button type="submit" name="login" class="btn_3 full_width text-center" style="width: 100%!important;">Login Now</button>
                                        <p>
                                            Need an account?
                                            <a data-toggle="modal" data-target="#sing_up" data-dismiss="modal" href="register.php">
                                                Sign Up
                                            </a>
                                        </p>
                                        <div class="text-center">
                                            <a href="forget.php" data-toggle="modal" data-target="#forgot_password" data-dismiss="modal" class="pass_forget_btn">
                                                Forget Password?
                                            </a>
                                        </div>
                                    </form>
                                    <?php
                                    if (isset($_POST['login']))
                                    {
                                        $email = mysqli_real_escape_string($db, $_POST['email']);
                                        $password = mysqli_real_escape_string($db, $_POST['password']);
                                        $sql = mysqli_query($db, "SELECT * FROM users WHERE email = '$email' AND password = '$password' AND status = 'Active'");
                                        $row = mysqli_fetch_array($sql);
                                        $count = mysqli_num_rows($sql);
                                        if ($count > 0)
                                        {
                                            $_SESSION['email'] = $email;
                                            $_SESSION['name'] = $row['name'];
                                            $_SESSION['img'] = $row['img'];
                                            $_SESSION['role'] = $row['role'];
                                            echo "<script>window.open('index.php','_self')</script>";
                                        }
                                        else
                                        {
                                            ?>
                                            <div class="alert text-white bg-primary d-flex align-items-center justify-content-between" style="margin-top: 20px; background: #BA704F!important;" role="alert">
                                                <div class="alert-text">
                                                    <strong>Hi <?php echo $_POST['email']; ?>!</strong>
                                                    Take An Error! Try Again.
                                                </div>
                                                <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                                                    <i class="ti-close text-white f_s_14"></i>
                                                </button>
                                            </div>
                                            <?php
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