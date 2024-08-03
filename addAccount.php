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
                                            <h5 class="modal-title text_white">Add New Account</h5>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post" enctype="multipart/form-data">
                                                <div class>
                                                    <input type="text" name="bank" class="form-control" placeholder="Bank Name">
                                                </div>
                                                <div class>
                                                    <input type="text" name="title" class="form-control" placeholder="Account Tile">
                                                </div>
                                                <div class>
                                                    <input type="text" name="ac_num" class="form-control" placeholder="Account Number">
                                                </div>
                                                <div class>
                                                    <input type="text" name="transfer_content" class="form-control" placeholder="Transfer Content">
                                                </div>
                                                <div class>
                                                    <input type="file" name="img" title="Select QR Code" class="form-control" accept="image/*">
                                                </div>
                                                <button type="submit" name="save" class="btn_3 full_width text-center" style="width: 100%!important;">
                                                    <i class="fas fa-save"></i>SAVE
                                                </button>
                                            </form>
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

if (isset($_POST['save']))
{
    $bank = mysqli_real_escape_string($db, $_POST['bank']);
    $title = mysqli_real_escape_string($db, $_POST['title']);
    $ac_num = mysqli_real_escape_string($db, $_POST['ac_num']);
    $transfer_content = mysqli_real_escape_string($db, $_POST['transfer_content']);
    $temp = explode(".", $_FILES["img"]["name"]);
    $newfilename = $_SESSION['email'] . '.' . rand() . '.' . end($temp);
    if (empty($_FILES["img"]["name"]))
    {
            echo "<script>alert('Select QR Code Please! Try again.')</script>";
            echo "<script>window.open('addAccount.php', '_self')</script>";
    }
    else
    {
        $update = mysqli_query($db, "INSERT INTO `accounts`(`bank`, `title`, `ac_num`, `transfer_content`, `img`) VALUES ('$bank', '$title', '$ac_num', '$transfer_content', '$newfilename')");
        if ($update)
        {
            $move = move_uploaded_file($_FILES["img"]["tmp_name"], "img/accounts/" . $newfilename);
            if ($move)
            {
                echo "<script>window.open('accounts.php', '_self')</script>";
            }

        }
    }
}
?>
