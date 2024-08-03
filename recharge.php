<?php
ob_start();
session_start();
include "db/db.php";
if (!isset($_SESSION['email']))
{
    header("Location: login.php");
}

if ($_SESSION['role'] == 'Admin')
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
            <div class="container-fluid p-0 ">

                <div class="row ">
                    <div class="col-xl-12">
                        <div class="white_card card_height_100 mb_30">
                            <div class="white_card_header">
                                <div class="row align-items-center">
                                    <div class="col-lg-4">
                                        <div class="main-title">
                                            <h3 class="m-0 text-uppercase">Recharge Your Account</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="white_card_body ">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="row">
                                        <?php
                                        $sql = mysqli_query($db, "SELECT * FROM `accounts` ORDER by id ASC");
                                        while ($row = mysqli_fetch_array($sql))
                                        {
                                            ?>
                                            <div class="col-sm-4" style="background: linear-gradient(134deg, #04a468 0%, #0d788c 100%); border-radius: 10px; margin-top: 10px;">
                                                <h3 class="text-white">Deposit Information</h3>
                                                <p style="color: #fff!important;">
                                                    <?php echo $row['bank']; ?>
                                                </p>
                                                <hr>
                                                <p style="color: #fff!important;">
                                                    <lable>Account holder: </lable>
                                                    <br>
                                                    <?php echo $row['title']; ?>
                                                </p>
                                                <hr>
                                                <p style="color: #fff!important;">
                                                    <label>Account number:</label>
                                                    <br>
                                                    <?php echo $row['ac_num']; ?>
                                                </p>
                                                <hr>
                                                <p style="color: #fff!important;">
                                                    <label>Transfer content:</label>
                                                    <br>
                                                    <?php echo $row['transfer_content']; ?>
                                                </p>
                                                <hr>
                                                <p style="text-align: justify!important; color: #fff!important;">
                                                    The system will automatically add money to your account after about 1-5 minutes. If money has not been added after more than 2 hours, please contact admin for support.
                                                </p>
                                            </div>
                                            <div class="col-sm-8">
                                                <center>
                                                    <h3 style="font-weight: 700; color: #111036; font-size: 17px;">Scan QR code to pay</h3>
                                                    <p style="color: #04a468;">
                                                        Use <span style="font-weight: bold;">Internet Banking App</span> or camera application that supports QR code to scan the code
                                                    </p>
                                                    <a href="img/accounts/<?php echo $row['img']; ?>" target="_blank">
                                                        <img src="img/accounts/<?php echo $row['img']; ?>" style="width: 60%!important;">
                                                    </a>
                                                </center>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="modal-content cs_modal">
                                            <div class="modal-header theme_bg_1" style="background: #1d2c48!important;">
                                                <h5 class="modal-title text_white">Upload Payment Proof to Credit amount into Your Account</h5>
                                            </div>
                                            <div class="modal-body">
                                                <form action="" method="post" enctype="multipart/form-data">
                                                    <div class>
                                                        <label for="">Amount Transfer</label>
                                                        <input type="number" name="total_amount" class="form-control" placeholder="Amount Transfer" required>
                                                    </div>
                                                    <div class>
                                                        <label>Payment Date</label>
                                                        <input type="date" name="date" class="form-control" placeholder="Select Payment Date" title="Select Payment Date" required>
                                                    </div>
                                                    <div class>
                                                        <label for="">Choose Bank in Which you transfer Money</label>
                                                        <select id="inputState" class="form-control" name="bank" required>
                                                            <?php
                                                            $sql = mysqli_query($db, "SELECT * FROM `accounts` ORDER by id ASC");
                                                            while ($row = mysqli_fetch_array($sql))
                                                            {
                                                                ?>
                                                                <option><?php echo $row['bank']; ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div style="margin-top: 20px;">
                                                        <input type="file" name="img" title="Select Payment Prof" class="form-control" accept="image/*" required>
                                                    </div>
                                                    <button type="submit" name="save" class="btn_3 full_width text-center" style="width: 100%!important;">
                                                        <i class="fas fa-save"></i>SAVE
                                                    </button>
                                                </form>
                                                <?php

                                                if (isset($_POST['save']))
                                                {
                                                    $bank = mysqli_real_escape_string($db, $_POST['bank']);
                                                    $date = mysqli_real_escape_string($db, $_POST['date']);
                                                    $total_amount = mysqli_real_escape_string($db, $_POST['total_amount']);
                                                    $temp = explode(".", $_FILES["img"]["name"]);
                                                    $newfilename = $_SESSION['email'] . '.' . rand() . '.' . end($temp);
                                                    $sqlOrderRows = mysqli_num_rows(mysqli_query($db, "SELECT * FROM credits ORDER BY invoice_no DESC"));
                                                    $sqlOrder = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM credits ORDER BY invoice_no DESC"));
                                                    if ($sqlOrderRows == 0)
                                                    {
                                                        $orderid = 1000;
                                                        $invoice = $orderid + 1;
                                                    }
                                                    else
                                                    {
                                                        $orderid = $sqlOrder['invoice_no'];
                                                        $invoice = $orderid + 1;
                                                    }
                                                    if (empty($_FILES["img"]["name"]))
                                                    {
                                                        echo "<script>alert('Select Payment Prof!')</script>";
                                                        echo "<script>window.open('recharge.php', '_self')</script>";
                                                    }
                                                    else
                                                    {
                                                        $update = mysqli_query($db, "INSERT INTO `credits`(`email`, `invoice_no`, `total_amount`, `bank`, `payment_date`, `payment_method`, `status`, `prof`) 
                                                                                   VALUES ('".$_SESSION['email']."', '$invoice', '$total_amount', '$bank', '$date', 'Bank Transfer', 'UnVerified', '$newfilename')");
                                                        if ($update)
                                                        {
                                                            $move = move_uploaded_file($_FILES["img"]["tmp_name"], "img/payments/" . $newfilename);
                                                            if ($move)
                                                            {
                                                                ?>
                                                                <div class="alert text-white bg-primary d-flex align-items-center justify-content-between" style="margin-top: 20px; background: #BA704F!important;" role="alert">
                                                                    <div class="alert-text">
                                                                        <strong>Hi <?php echo $_SESSION['email']; ?>!</strong>
                                                                        Payment has been added! Wait for Verification.
                                                                        <center>
                                                                            <a href="paymentsHistory.php" class="btn_3" style="margin-top: 20px;">
                                                                                Go To Payment History Page <i class="fas fa-list"></i>
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
                    </div>
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