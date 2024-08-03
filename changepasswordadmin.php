<?php
ob_start();
session_start();
include "db/db.php";
if (!isset($_SESSION['email']))
{
    header("Location: login.php");
}
if ($_SESSION['role'] == 'User')
{
    header("Location: index.php");
}
include "inc/head.php";
?>
<body class="crm_body_bg">

<?php
include "inc/sidebar.php";
?>

<section class="main_content dashboard_part large_header_bg">

    <?php
    include "inc/navbar.php";
    ?>

    <div class="main_content_iner overly_inner ">

        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <div class="white_box_50px mb_30" style="padding: 20px; margin: 20px;">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="modal-content cs_modal">
                                    <div class="modal-header theme_bg_1" style="background: #1d2c48!important;">
                                        <h5 class="modal-title text_white">Change Password for "<?php echo $_GET['name']; ?>"</h5>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <div class>
                                                <input type="password" name="newpassword" class="form-control" placeholder="New Password" required>
                                            </div>
                                            <div class>
                                                <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm New Password" required>
                                            </div>
                                            <button type="submit" name="login" class="btn_3 full_width text-center" style="width: 100%!important;">Change Password</button>
                                        </form>
                                        <?php
                                        if (isset($_POST['login']))
                                        {
                                            $newpassword = mysqli_real_escape_string($db, $_POST['newpassword']);
                                            $confirmpassword = mysqli_real_escape_string($db, $_POST['confirmpassword']);
                                            $id = $_GET['id'];
                                            if ($newpassword == $confirmpassword)
                                            {
                                                $sqlup = mysqli_query($db, "UPDATE users SET password = '$newpassword' WHERE id = '$id'");
                                                if ($sqlup)
                                                {
                                                    echo "<script>window.open('admins.php','_self')</script>";
                                                }
                                            }
                                            else
                                            {
                                                ?>
                                                <div class="alert text-white bg-danger d-flex align-items-center justify-content-between" style="margin-top: 20px;" role="alert">
                                                    <div class="alert-text">
                                                        <strong>Hi <?php echo $_SESSION['email']; ?>!</strong>
                                                        New Password does not Match! Try Again.
                                                    </div>
                                                    <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                                                        <i class="ti-close text-white f_s_14"></i>
                                                    </button>
                                                </div>
                                            <?php                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-1"></div>
            </div>
        </div>

    </div>

    <?php
    include "inc/footer.php";
    ?>
</section>

<?php
include "inc/js_footer.php";
?>
