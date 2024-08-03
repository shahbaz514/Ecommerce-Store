<?php
ob_start();
session_start();
include "db/db.php";
if (!isset($_SESSION['email']))
{
    header("Location: login.php");
}
include "inc/head.php";
$error = "";
?>
<body class="crm_body_bg">

<?php
include "inc/sidebar.php";

if (isset($_GET['service']))
{
    $sqlPro = mysqli_query($db, "SELECT * FROM `products` WHERE service_id = '".$_GET['service']."'");
}
else
{
    $sqlPro = mysqli_query($db, "SELECT * FROM `products`");
}
while ($rowPro =mysqli_fetch_array($sqlPro))
{
    ?>
    <form action="" enctype="multipart/form-data" method="post">
        <div class="modal fade" id="exampleModalLong<?php echo $rowPro['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            <?php
                            echo $rowPro['name'];
                            ?>
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5 class="text-center">
                            <label for="">
                                Enter the quantity you want to buy:
                            </label>
                            <center>
                                <input type="number" value="1" class="form-control" name="qty<?php echo $rowPro['id']; ?>" max="<?php echo $rowPro['stack_qty']; ?>" style="width: 150px;" placeholder="Enter the quantity you want to buy:" required>
                            </center>
                        </h5>
                        <input type="number" name="price<?php echo $rowPro['id']; ?>"  value="<?php echo $rowPro['price']; ?>" style="display: none;">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" name="orderPlace<?php echo $rowPro['id']; ?>" class="btn btn-danger">
                            Pay Now
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <?php
    $id = "orderPlace".$rowPro['id'];
    if (isset($_POST[$id]))
    {
        $pid = $rowPro['id'];
        $email = $_SESSION['email'];
        $postQty = "qty".$rowPro['id'];
        $qty = $_POST[$postQty];
        $postprice = "price".$rowPro['id'];
        $price = $_POST[$postprice];
        $total = 0;
        $total = $qty * $price;
        $sqlSer = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM products WHERE id = '$pid'"));
        $service_id = $sqlSer['service_id'];
        $stock_qty = $sqlSer['stack_qty'];

        $sqlWallet = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM users WHERE email = '$email'"));
        $wallet = $sqlWallet['wallet'];
        $sqlOrderRows = mysqli_num_rows(mysqli_query($db, "SELECT * FROM orders ORDER BY orderid DESC"));
        if ($sqlOrderRows == 0)
        {
            $orderid = 1000;
            $newOrderId = $orderid + 1;
        }
        else
        {
            $sqlOrder = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM orders ORDER BY orderid DESC"));
            $orderid = $sqlOrder['orderid'];
            $newOrderId = $orderid + 1;
        }

        if ($wallet >= $total)
        {
            $sqlInsert = mysqli_query($db, "INSERT INTO `orders`(`orderid`, `status`, `service`, `pro_id`, `qty`, `price`, `totalprice`, `email`)
                                                                VALUES ('$newOrderId','Completed','$service_id','$pid', '$qty', '$price', '$total','$email')");
            if ($sqlInsert)
            {
                $wallet = $wallet - $total;
                $sqlUpdateUser = mysqli_query($db, "UPDATE users SET wallet = '$wallet' WHERE email = '$email'");
                if ($sqlUpdateUser)
                {
                    $newStock = $stock_qty - $qty;
                    $sqlUpdatePro = mysqli_query($db, "UPDATE `products` SET `stack_qty`='$newStock' WHERE id = '$pid'");
                    if ($sqlUpdatePro)
                    {
                        for ($i = 0; $i<$qty; $i++)
                        {
                            $sqlProGet = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `product_uploads` WHERE pro_id = '$pid' AND email = '' ORDER BY id ASC"));
                            $proGetId = $sqlProGet['id'];
                            $sqlProRes = mysqli_query($db, "UPDATE `product_uploads` SET `email`='$email',`orderid`='$newOrderId' WHERE pro_id = '$pid' AND id = '$proGetId'");
                        }
                        $error = '
                        <div class="alert text-white bg-primary d-flex align-items-center justify-content-between" style="margin-top: 20px; background: #BA704F!important;" role="alert">
                            <div class="alert-text">
                                <strong>Hi ' . $_SESSION['email'] . '!</strong>
                                Your Order Placed Successfully.
                                <center>
                                    <a href="orderHistory.php" class="btn_3" style="margin-top: 20px;">
                                        Go To Orders Page <i class="fas fa-list"></i>
                                    </a>
                                </center>
                            </div>
                            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="ti-close text-white f_s_14"></i>
                            </button>
                        </div>
                        ';
                    }
                }
            }
            else
            {
                $error = '
                <div class="alert text-white bg-danger d-flex align-items-center justify-content-between" style="margin-top: 20px;" role="alert">
                    <div class="alert-text">
                        <strong>Hi ' . $_SESSION['email'] . '!</strong>
                        Take an Error! Try Again
                        <center>
                            <a href="shop.php" class="btn_3" style="margin-top: 20px;">
                                Go To Shop Page <i class="fas fa-shopping-cart"></i>
                            </a>
                        </center>
                    </div>
                    <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                        <i class="ti-close text-white f_s_14"></i>
                    </button>
                </div>
                ';
            }
        }
        else {
            $error = '
            <div class="alert text-white bg-danger d-flex align-items-center justify-content-between" style="margin-top: 20px;" role="alert">
                <div class="alert-text">
                    <strong>Hi ' . $_SESSION['email'] . '!</strong>
                    InSufficient Balance! Please Recharge your Account First
                    <center>
                        <a href="recharge.php" class="btn_3" style="margin-top: 20px;">
                            Go To Recharge Page <i class="fas fa-home"></i>
                        </a>
                    </center>
                </div>
                <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                    <i class="ti-close text-white f_s_14"></i>
                </button>
            </div>
            ';
        }
    }
}
?>

<section class="main_content dashboard_part large_header_bg">

    <?php
    include "inc/navbar.php";
    ?>

    <div class="main_content_iner overly_inner ">
        <div class="container-fluid p-0 ">
            <div class="row ">
                <?php
                if ($_SESSION['role'] == 'Admin')
                {
                    include "inc/home_admin.php";
                }
                else
                {
                    ?>

                    <div class="main_content_iner ">
                        <div class="container-fluid p-0 sm_padding_15px">
                            <div class="row justify-content-center">
                                <!--<div class="col-12">
                                    <div class="dashboard_header mb_50">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="dashboard_header_title">
                                                    <h3> Welcome To Our Website</h3>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="dashboard_breadcam text-end">
                                                    <p>
                                                        <a href="index.php">Dashboard</a>
                                                        <i class="fas fa-caret-right"></i>
                                                        Home
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->

                                <div class="col-lg-12">
                                    <div class="card_box box_shadow">
                                        <div class="box_body">
                                            <div class="default-according">
                                                <div class="card">
                                                    <div class="card-header" style="background: #6C3428!important;">
                                                        <h5 class="mb-0">
                                                            <button class="btn text_white">
                                                                <i class="fas fa-question"></i>
                                                                FAQ
                                                            </button>
                                                        </h5>
                                                    </div>
                                                    <div>
                                                        <div class="card-body">
                                                            <?php
                                                            $sqlGetFAQ = mysqli_query($db, "SELECT * FROM blog ORDER BY id ASC LIMIT 0,5");
                                                            while ($rowGetFAQ = mysqli_fetch_array($sqlGetFAQ))
                                                            {
                                                                ?>
                                                                <a href="singleBlog.php?id=<?php echo $rowGetFAQ['id']; ?>" class="btn">
                                                                    <i class="fas fa-check-circle"></i>
                                                                    <?php echo $rowGetFAQ['name']; ?>
                                                                </a>
                                                                <br>
                                                                <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="card_box box_shadow">
                                        <div class="box_body">
                                            <div class="default-according">
                                                <div class="card">
                                                    <div class="card-header" style="background: #6C3428!important;">
                                                        <h5 class="mb-0">
                                                            <button class="btn text_white">
                                                                <i class="fas fa-yin-yang"></i>
                                                                Website Notification
                                                            </button>
                                                        </h5>
                                                    </div>
                                                    <div>
                                                        <div class="card-body">
                                                            <?php echo $site['site_notice']; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-4"></div>
                                        <div class="col-sm-4">
                                            <?php
                                            echo @$error;
                                            ?>
                                        </div>
                                        <div class="col-sm-4"></div>
                                    </div>
                                    <?php
                                    include "inc/home_user.php";
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
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

