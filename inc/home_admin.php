<div class="col-xl-6">
    <div class="white_card card_height_100 mb_30 user_crm_wrapper">
        <div class="row">
            <div class="col-lg-6">
                <div class="single_crm">
                    <div class="crm_head d-flex align-items-center justify-content-between">
                        <div class="thumb">
                            <img src="img/crm/businessman.svg" alt>
                        </div>
                        <i class="fas fa-ellipsis-h f_s_11 white_text"></i>
                    </div>
                    <div class="crm_body">
                        <h4>
                            <?php
                            echo mysqli_num_rows(mysqli_query($db, "SELECT * FROM users WHERE role = 'Admin'"));
                            ?>
                        </h4>
                        <p>All Admins</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="single_crm ">
                    <div class="crm_head crm_bg_1 d-flex align-items-center justify-content-between">
                        <div class="thumb">
                            <img src="img/crm/customer.svg" alt>
                        </div>
                        <i class="fas fa-ellipsis-h f_s_11 white_text"></i>
                    </div>
                    <div class="crm_body">
                        <h4>
                            <?php
                            echo mysqli_num_rows(mysqli_query($db, "SELECT * FROM users WHERE role = 'User'"));
                            ?>
                        </h4>
                        <p>All Users</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="single_crm">
                    <div class="crm_head crm_bg_2 d-flex align-items-center justify-content-between">
                        <div class="thumb">
                            <img src="img/crm/infographic.svg" alt>
                        </div>
                        <i class="fas fa-ellipsis-h f_s_11 white_text"></i>
                    </div>
                    <div class="crm_body">
                        <h4>

                            <?php
                            echo mysqli_num_rows(mysqli_query($db, "SELECT * FROM users WHERE role = 'User' AND status = 'Active'"));
                            ?>

                        </h4>
                        <p>Verified Users</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="single_crm">
                    <div class="crm_head crm_bg_3 d-flex align-items-center justify-content-between">
                        <div class="thumb">
                            <img src="img/crm/sqr.svg" alt>
                        </div>
                        <i class="fas fa-ellipsis-h f_s_11 white_text"></i>
                    </div>
                    <div class="crm_body">
                        <h4>
                            <?php
                            echo mysqli_num_rows(mysqli_query($db, "SELECT * FROM users WHERE role = 'User' AND status = 'UnVerified'"));
                            ?>
                        </h4>
                        <p>Unverified Users</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-6">
    <div class="white_card card_height_100 mb_30 overflow_hidden">
        <div class="white_card_header">
            <div class="box_header m-0">
                <div class="main-title">
                    <h3 class="m-0">Sales/Products/Services Details</h3>
                </div>
            </div>
        </div>
        <div class="white_card_body pb-0">
            <div class="Sales_Details_plan">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="single_plan d-flex align-items-center justify-content-between">
                            <div class="plan_left d-flex align-items-center">
                                <div class="thumb">
                                    <img src="img/icon2/3.svg" alt>
                                </div>
                                <div>
                                    <h5>
                                        <?php
                                        echo mysqli_num_rows(mysqli_query($db, "SELECT * FROM services"));
                                        ?>
                                    </h5>
                                    <span>Total Services</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="single_plan d-flex align-items-center justify-content-between">
                            <div class="plan_left d-flex align-items-center">
                                <div class="thumb">
                                    <img src="img/icon2/1.svg" alt>
                                </div>
                                <div>
                                    <h5>
                                        <?php
                                        echo mysqli_num_rows(mysqli_query($db, "SELECT * FROM products"));
                                        ?>
                                    </h5>
                                    <span>Total Products</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="single_plan d-flex align-items-center justify-content-between">
                            <div class="plan_left d-flex align-items-center">
                                <div class="thumb">
                                    <img src="img/icon2/4.svg" alt>
                                </div>
                                <div>
                                    <h5>
                                        <?php
                                        $total = 0;
                                        $totalDeposit =  mysqli_query($db, "SELECT * FROM users WHERE role = 'User'");
                                        while ($rowTotalDeposit = mysqli_fetch_array($totalDeposit))
                                        {
                                            $total = $total + $rowTotalDeposit['wallet'];
                                        }
                                        echo "$".$total;
                                        ?>
                                    </h5>
                                    <span>Total Amount Deposit</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="single_plan d-flex align-items-center justify-content-between">
                            <div class="plan_left d-flex align-items-center">
                                <div class="thumb">
                                    <img src="img/icon2/2.svg" alt>
                                </div>
                                <div>
                                    <h5>
                                        <?php
                                        $total = 0;
                                        $totalOrders =  mysqli_query($db, "SELECT * FROM orders");
                                        while ($rowTotalOrders = mysqli_fetch_array($totalOrders))
                                        {
                                            $total = $total + $rowTotalOrders['totalprice'];
                                        }
                                        echo "$".$total;
                                        ?>
                                    </h5>
                                    <span>All Time Sales</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-4">
    <div class="white_card card_height_100 mb_30">
        <div class="white_card_header">
            <div class="row align-items-center">
                <div class="col-lg-4">
                    <div class="main-title">
                        <h3 class="m-0">New Users</h3>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row justify-content-end">
                        <div class="col-lg-8 d-flex justify-content-end">
                            <div class="serach_field-area theme_bg d-flex align-items-center">
                                <div class="search_inner">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="search_field">
                                            <input type="text" placeholder="Search" name="search">
                                        </div>
                                        <button type="submit" name="search_btn">
                                            <img src="img/icon/icon_search.svg" alt>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="white_card_body ">

            <?php
            if (isset($_POST['search_btn']))
            {
                $search = $_POST['search'];
                $sql = mysqli_query($db, "SELECT * FROM `users` WHERE name LIKE '%$search%' and role = 'User' ORDER BY id DESC LIMIT 0,5");
            }
            else
            {
                $sql = mysqli_query($db, "SELECT * FROM `users` WHERE role = 'User' ORDER by id DESC LIMIT 0,5");
            }
            while ($row = mysqli_fetch_array($sql))
            {
                ?>


                <div class="single_user_pil admin_bg d-flex align-items-center justify-content-between">
                    <div class="user_pils_thumb d-flex align-items-center">
                        <div class="thumb_34 mr_15 mt-0">
                            <?php
                            if ($row['img'] == "")
                            {
                                echo '<img class="img-fluid radius_50" src="img/customers/1.png" alt>';
                            }
                            else
                            {
                                echo '<a href="img/users/'.$row['img'].'" target="_blank"><img class="img-fluid radius_50" src="img/users/'.$row['img'].'" alt></a>';
                            }
                            ?>
                        </div>
                        <span class="f_s_14 f_w_400 text_color_11" style="padding: 10px;">
                                        <a href="viewProfile.php?id=<?php echo $row['id'] ?>">
                                            <?php echo $row['name'] ?>
                                        </a>
                                    </span>
                    </div>
                    <div class="user_info">
                        <?php echo $row['role'] ?>
                    </div>
                    <div class="action_btns d-flex">
                        <?php
                        if ($row['status'] == 'Active')
                        {
                            ?>
                            <a href="users.php?status=<?php echo $row['id'] ?>" class="action_btn">
                                <i class="fas fa-user-check"></i>
                            </a>
                            <?php
                        }
                        else
                        {
                            ?>
                            <a href="users.php?status=<?php echo $row['id'] ?>" class="action_btn">
                                <i class="fas fa-user-times"></i>
                            </a>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>
<div class="col-lg-4">
    <div class="white_card card_height_100 mb_20 ">
        <div class="white_card_header">
            <div class="box_header m-0">
                <div class="main-title">
                    <h3 class="m-0">Latest Products</h3>
                </div>
            </div>
        </div>
        <div class="white_card_body QA_section">
            <div class="QA_table ">

                <table class="table lms_table_active2 p-0">
                    <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Stuck QTY</th>
                        <th scope="col">Service Category</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    $sql = mysqli_query($db, "SELECT * FROM `products` ORDER by id DESC LIMIT 0,5");
                    while ($row = mysqli_fetch_array($sql))
                    {
                        ?>
                        <tr>
                            <td class="f_s_12 f_w_400 color_text_6">
                                <?php echo $row['name']; ?>
                            </td>
                            <td class="f_s_12 f_w_400 color_text_7">
                                <?php echo $row['price']; ?>
                            </td>
                            <td class="f_s_12 f_w_400 color_text_6">
                                <?php echo $row['stack_qty']; ?>
                            </td>
                            <td class="f_s_12 f_w_400 color_text_6">
                                <?php
                                $rowservice =  mysqli_fetch_array(mysqli_query($db, 'SELECT name FROM services WHERE id = "'.$row['service_id'].'"'));
                                echo $rowservice['name'];
                                ?>
                            </td>
                            <td class="f_s_12 f_w_400 text-end">
                                <a href="editProduct.php?edit=<?php echo $row['id'] ?>" class="action_btn">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                            <td class="f_s_12 f_w_400 text-end">
                                <a href="products.php?del=<?php echo $row['id'] ?>" class="action_btn">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-4">
    <div class="white_card card_height_100 mb_20 ">
        <div class="white_card_header">
            <div class="box_header m-0">
                <div class="main-title">
                    <h3 class="m-0">Latest Services</h3>
                </div>
            </div>
        </div>
        <div class="white_card_body QA_section">
            <div class="QA_table ">

                <?php
                $sql = mysqli_query($db, "SELECT * FROM `services` ORDER by id DESC LIMIT 0,5");
                while ($row = mysqli_fetch_array($sql))
                {
                    ?>
                    <div class="single_user_pil admin_bg d-flex align-items-center justify-content-between">
                        <div class="user_pils_thumb d-flex align-items-center">
                            <div class="thumb_34 mr_15 mt-0">
                                <a href="img/services/<?php echo $row['img']; ?>" target="_blank">
                                    <img class="img-fluid radius_50" src="img/services/<?php echo $row['img']; ?>" alt>
                                </a>
                            </div>
                            <span class="f_s_14 f_w_400 text_color_11" style="padding: 10px;">
                                        <?php echo $row['name'] ?>
                                    </span>
                        </div>
                        <div class="user_info">
                            <?php echo $row['status'] ?>
                        </div>
                        <div class="action_btns d-flex">
                            <?php
                            if ($row['status'] == 'Active')
                            {
                                ?>
                                <a href="services.php?status=<?php echo $row['id'] ?>" class="action_btn">
                                    <i class="fas fa-check"></i>
                                </a>
                                <?php
                            }
                            else
                            {
                                ?>
                                <a href="services.php?status=<?php echo $row['id'] ?>" class="action_btn">
                                    <i class="fas fa-times"></i>
                                </a>
                                <?php
                            }
                            ?>
                            <a href="services.php?del=<?php echo $row['id'] ?>" class="action_btn">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>