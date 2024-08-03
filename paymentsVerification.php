<?php
ob_start();
session_start();
include "db/db.php";
if (!isset($_SESSION['email']))
{
    header("Location: login.php");
}
if (isset($_GET['status']))
{
    $sqlGetCredit = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `credits` WHERE invoice_no = '".$_GET['status']."'"));
    $sqlGetUser = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM users WHERE email = '".$sqlGetCredit['email']."'"));

    $availableBalance = $sqlGetUser['wallet'];
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
                                        <h5 class="modal-title text_white">Payment Verification "<?php echo $_GET['status']; ?>"</h5>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <div class>
                                                <h5>
                                                    Do you want to Verify the Payment for Invoice No Equals to <span style="font-weight: bold; color: darkred;"><?php echo $_GET['status']; ?></span>
                                                </h5>
                                            </div>
                                            <button type="submit" name="login" class="btn_2 full_width text-center" style="width: 100%!important;">
                                                <?php
                                                if ($sqlGetCredit['status'] == "Verified")
                                                {
                                                    echo "UnVerify Payment";
                                                }
                                                else
                                                {
                                                    echo "Verify Payment";
                                                }
                                                ?>
                                            </button>
                                            <a href="payments.php" class="btn btn_3 full_width text-center" style="width: 100%!important; margin-top: 20px;">
                                                Go Back <i class="fas fa-arrow-circle-left"></i>
                                            </a>
                                        </form>
                                        <?php
                                        if (isset($_POST['login']))
                                        {
                                            if ($sqlGetCredit['status'] == "Verified") {
                                                $availableBalance = $availableBalance - $sqlGetCredit['total_amount'];
                                                $sqlupUser = mysqli_query($db, "UPDATE users SET wallet = '$availableBalance' WHERE email = '" . $sqlGetCredit['email'] . "'");
                                                if ($sqlupUser) {
                                                    $sqlupCredit = mysqli_query($db, "UPDATE credits SET status = 'UnVerified' WHERE invoice_no = '" . $_GET['status'] . "'");
                                                    if ($sqlupCredit) {
                                                        ?>
                                                        <div class="alert text-white bg-primary d-flex align-items-center justify-content-between" style="margin-top: 20px; background: #BA704F!important;" role="alert">
                                                            <div class="alert-text">
                                                                <strong>Hi <?php echo $_SESSION['email']; ?>!</strong>
                                                                Payment status has been Updated.
                                                                <center>
                                                                    <a href="payments.php" class="btn_3" style="margin-top: 20px;">
                                                                        Go To Payments Page <i class="fas fa-credit-card"></i>
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
                                            }
                                            else {
                                                $availableBalance = $availableBalance + $sqlGetCredit['total_amount'];
                                                $sqlupUser = mysqli_query($db, "UPDATE users SET wallet = '$availableBalance' WHERE email = '" . $sqlGetCredit['email'] . "'");
                                                if ($sqlupUser) {
                                                    $sqlupCredit = mysqli_query($db, "UPDATE credits SET status = 'Verified' WHERE invoice_no = '" . $_GET['status'] . "'");
                                                    if ($sqlupCredit) {
                                                        ?>
                                                        <div class="alert text-white bg-primary d-flex align-items-center justify-content-between" style="margin-top: 20px; background: #BA704F!important;" role="alert">
                                                            <div class="alert-text">
                                                                <strong>Hi <?php echo $_SESSION['email']; ?>!</strong>
                                                                Payment status has been Updated.
                                                                <center>
                                                                    <a href="payments.php" class="btn_3" style="margin-top: 20px;">
                                                                        Go To Payments Page <i class="fas fa-credit-card"></i>
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
                                            }
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
}
else
{
    header("Location: payments.php");
}

?>
