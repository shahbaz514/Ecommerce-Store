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
        else
        {
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

                <div class="row">
                    <div class="col-12">
                        <div class="page_title_box d-flex align-items-center justify-content-between">
                            <div class="page_title_left">
                                <h3 class="f_s_30 f_w_700 dark_text">Buy</h3>
                                <ol class="breadcrumb page_bradcam mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="index.php">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active">Shop</li>
                                </ol>
                            </div>
                            <a href="orderHistory.php" class="white_btn3">Order History</a>
                        </div>
                    </div>
                </div>
                <div class="row">
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
                    </div>
                    <?php
                    if (isset($_GET['service']))
                    {
                        $sqlPro = mysqli_query($db, "SELECT * FROM `products` WHERE service_id = '".$_GET['service']."'");
                    }
                    else if (isset($_POST['search_btn']))
                    {
                        $search = $_POST['search'];
                        $sqlPro = mysqli_query($db, "SELECT * FROM `products` WHERE name LIKE '%$search%' ORDER BY id DESC");
                    }
                    else
                    {
                        $sqlPro = mysqli_query($db, "SELECT * FROM `products`");
                    }
                    while ($rowPro =mysqli_fetch_array($sqlPro))
                    {
                        ?>
                        <div class="col-sm-3" style="margin-top: 20px;">
                            <div class="white_card position-relative">
                                <div class="card-header" style="background: #6C3428!important;color: #fff; min-height: 100px!important;">
                                    <?php
                                    echo $rowPro['name'];
                                    ?>
                                </div>
                                <style>
                                    .price_shahbaz514{
                                        font-weight: 700;
                                        color: #6C3428!important;
                                        text-align: center;
                                    }
                                    .stock_qty_shahbaz514{
                                        color: #fff8d5;
                                        background: #6C3428!important;
                                        width: max-content;
                                        border-radius: 5px;
                                        padding: 10px;
                                    }
                                    .h5_shahbaz514{
                                        color: #000000;
                                        font-weight: 700;
                                        font-size: 17px;
                                        color: #fff;
                                        background: darkorange;
                                        padding: 10px;
                                        border-radius: 10px;
                                        width: max-content;
                                        align-items: center;
                                        text-align: center!important;
                                    }
                                </style>
                                <div class="card-body">
                                    <div class="row my-4 single-pro-detail">
                                        <h5 class="price_shahbaz514">
                                            $<?php echo $rowPro['price']; ?>
                                        </h5>
                                        <p style="text-align: center!important;" class="text-uppercase">
                                            Remaining: <span class="stock_qty_shahbaz514"><?php echo $rowPro['stack_qty']; ?></span>
                                        </p>
                                        <div class="single-pro-detail"  style="float: left!important; min-height: 400px!important; margin-top: 20px;">
                                            <p style="text-align: justify;">
                                                <?php echo $rowPro['description']; ?>
                                            </p>
                                            <ul class="list-unstyled pro-features border-0">
                                                <?php
                                                $sqlProFeatures = mysqli_query($db, "SELECT * FROM `products_features` WHERE pro_id = '".$rowPro['id']."'");
                                                while ($rowProFeatures = mysqli_fetch_array($sqlProFeatures))
                                                {
                                                    echo '<li>'.$rowProFeatures['name'].'</li>';
                                                }
                                                //<a href="editFeature.php?edit='.$rowProFeatures['id'].'" class="btn_2"><i class="fas fa-edit"></i></a>
                                                ?>
                                            </ul>
                                        </div>
                                        <div class="text-center my-4">
                                            <center>
                                                <h5 class="text-uppercase text-white rounded" style="background: #BA704F!important;">
                                                    Service Category: <?php
                                                    $sqlService = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `services` WHERE id = '".$rowPro['service_id']."'"));
                                                    echo $sqlService['name'];
                                                    ?>
                                                </h5>
                                            </center>
                                        </div>
                                    </div>
                                    <div class="d-grid">
                                        <?php
                                        if ($rowPro['stack_qty'] == 0)
                                        {
                                            echo '
                                            <center>
                                                <button class="btn_3" style="width: max-content;" disabled>
                                                    <i class="fas fa-cart-plus"></i> Add To Cart
                                                </button>
                                            </center>
                                            ';
                                        }
                                        else
                                        {
                                            echo '
                                            <center>
                                                <button type="button" class="btn btn_3" style="width: max-content;" data-bs-toggle="modal" data-bs-target="#exampleModalLong'.$rowPro['id'].'">
                                                    <i class="fas fa-cart-plus"></i> Add To Cart
                                                </button>
                                            </center>
                                            ';
                                        }
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