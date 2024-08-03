<nav class="sidebar">
    <div class="logo d-flex justify-content-between">
        <a class="large_logo" href="index.php">
            <img src="img/site/<?php echo $site['site_logo']; ?>" alt>
        </a>
        <a class="small_logo" href="index.php">
            <img src="img/site/<?php echo $site['site_logo']; ?>" alt>
        </a>
        <div class="sidebar_close_icon d-lg-none">
            <i class="ti-close"></i>
        </div>
    </div>
    <div class="card custom-card">
        <div class="card-header">
            <img class="img-fluid" src="img/profilebox/1.jpg" alt data-original-title title>
        </div>
        <div class="card-profile">
            <?php
            if ($_SESSION['img'] == "")
            {
                echo '<img src="img/client_img.png" class="rounded-circle">';
            }
            else
            {
                ?>
                <img src="img/users/<?php echo $userCredentials['img']; ?>" class="rounded-circle">
                <?php
            }
            ?>
        </div>
        <div class="text-center profile-details">
            <h4><?php echo $userCredentials['name']; ?></h4>
            <h6><?php echo $userCredentials['role']; ?></h6>
            <style>
                .stock_qty_shahbaz514{
                    color: #fff8d5;
                    background: #6C3428!important;
                    width: max-content;
                    border-radius: 5px;
                    padding: 10px;
                }
            </style>
            <?php
            if ($_SESSION['role'] == 'User')
            {
                ?>
                <h6 class="text-uppercase" style="color: #6C3428;">
                    Balance: <span class="stock_qty_shahbaz514">
                        <?php echo "$ ".$userCredentials['wallet']; ?>
                    </span>
                </h6>
            <?php
            }
            ?>
        </div>
    </div>
    <ul id="sidebar_menu">
        <li class>
            <a href="profile.php" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="img/menu-icon/5.svg" alt>
                </div>
                <div class="nav_title">
                    <span>Account/Profile</span>
                </div>
            </a>
        </li>
        <?php
        if ($_SESSION['role'] == 'Admin')
        {
            ?>
            <li class>
                <a href="orders.php" aria-expanded="false">
                    <div class="nav_icon_small">
                        <i class="fas fa-history" style="color: #94c0d4!important;"></i>
                    </div>
                    <div class="nav_title">
                        <span>Orders</span>
                    </div>
                </a>
            </li>
            <li class>
                <a href="payments.php" aria-expanded="false">
                    <div class="nav_icon_small">
                        <i class="fas fa-credit-card" style="color: #94c0d4!important;"></i>
                    </div>
                    <div class="nav_title">
                        <span>Payments</span>
                    </div>
                </a>
            </li>
            <li class>
                <a href="products.php" aria-expanded="false">
                    <div class="nav_icon_small">
                        <i class="fas fa-list-ol" style="color: #94c0d4!important;"></i>
                    </div>
                    <div class="nav_title">
                        <span>Products</span>
                    </div>
                </a>
            </li>
            <li class>
                <a href="accounts.php" aria-expanded="false">
                    <div class="nav_icon_small">
                        <i class="fas fa-list" style="color: #94c0d4!important;"></i>
                    </div>
                    <div class="nav_title">
                        <span>Accounts</span>
                    </div>
                </a>
            </li>
            <li class>
                <a href="services.php" aria-expanded="false">
                    <div class="nav_icon_small">
                        <i class="fas fa-list-alt" style="color: #94c0d4!important;"></i>
                    </div>
                    <div class="nav_title">
                        <span>Services</span>
                    </div>
                </a>
            </li>
            <li class>
                <a href="users.php" aria-expanded="false">
                    <div class="nav_icon_small">
                        <i class="fas fa-users" style="color: #94c0d4!important;"></i>
                    </div>
                    <div class="nav_title">
                        <span>Users</span>
                    </div>
                </a>
            </li>
            <li class>
                <a href="admins.php" aria-expanded="false">
                    <div class="nav_icon_small">
                        <i class="fas fa-users" style="color: #94c0d4!important;"></i>
                    </div>
                    <div class="nav_title">
                        <span>Admins</span>
                    </div>
                </a>
            </li>
            <li class>
                <a href="blogs.php" aria-expanded="false">
                    <div class="nav_icon_small">
                        <i class="fas fa-users" style="color: #94c0d4!important;"></i>
                    </div>
                    <div class="nav_title">
                        <span>QA/Blogs</span>
                    </div>
                </a>
            </li>
            <li class>
                <a href="siteSettings.php" aria-expanded="false">
                    <div class="nav_icon_small">
                        <i class="fas fa-users" style="color: #94c0d4!important;"></i>
                    </div>
                    <div class="nav_title">
                        <span>Site Settings</span>
                    </div>
                </a>
            </li>
            <?php
        }
        else
        {
            ?>
            <li style="font-weight: bold!important; color: #000000!important; border: 2px dotted lightsteelblue; border-radius: 5px;">
                <a>
                    <div class="nav_icon_small">
                        <img src="img/menu-icon/dollar-3480.svg" alt>
                    </div>
                    <div class="nav_title">
                        <span>Pay</span>
                    </div>
                </a>
            </li>
            <li class>
                <a href="recharge.php">
                    <div class="nav_icon_small">
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="nav_title">
                            <span>
                                Recharge
                            </span>
                    </div>
                </a>
            </li>
            <li class>
                <a href="paymentsHistory.php">
                    <div class="nav_icon_small">
                        <i class="fas fa-list"></i>
                    </div>
                    <div class="nav_title">
                            <span>
                                Charge history
                            </span>
                    </div>
                </a>
            </li>
            <li class>
                <a href="orderHistory.php">
                    <div class="nav_icon_small">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <div class="nav_title">
                            <span>
                                Order history
                            </span>
                    </div>
                </a>
            </li>
            <li style="font-weight: bold!important; color: #000000!important; border: 2px dotted lightsteelblue; border-radius: 5px;">
                <a href="#">
                    <div class="nav_icon_small">
                        <i class="fas fa-shopping-cart" style="color: #94c0d4!important;"></i>
                    </div>
                    <div class="nav_title">
                        <span>Purchase</span>
                    </div>
                </a>
            </li>
            <?php
            $sql = mysqli_query($db, "SELECT * FROM `services` ORDER by id ASC");
            while ($row = mysqli_fetch_array($sql))
            {
                ?>
                <li class>
                    <a href="shop.php?service=<?php echo $row['id']; ?>">
                        <div class="nav_icon_small">
                            <img src="img/services/<?php echo $row['img']; ?>" alt="img/services/<?php echo $row['name']; ?>">
                        </div>
                        <div class="nav_title">
                            <span>
                                <?php echo $row['name'] ?>
                            </span>
                        </div>
                    </a>
                </li>
                <?php
            }
            ?>
            <?php
        }
        ?>
    </ul>
</nav>