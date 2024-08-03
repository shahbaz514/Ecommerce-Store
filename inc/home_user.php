
<div class="main_content_iner overly_inner ">
    <div class="container-fluid p-0 ">

        <div class="row">
            <div class="col-12">
                <div class="page_title_box d-flex align-items-center justify-content-between">
                    <div class="page_title_left">
                        <h3 class="f_s_30 f_w_700 dark_text">Latest Products</h3>
                    </div>
                    <a href="orderHistory.php" class="btn btn_3">Order History</a>
                </div>
            </div>
        </div>
        <div class="row">

            <?php
            if (isset($_GET['service']))
            {
                $sqlPro = mysqli_query($db, "SELECT * FROM `products` WHERE service_id = '".$_GET['service']."'");
            }
            if (isset($_POST['search_btn']))
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
