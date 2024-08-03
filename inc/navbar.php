
<div class="container-fluid g-0">
    <div class="row">
        <div class="col-lg-12 p-0 ">
            <div class="header_iner d-flex justify-content-between align-items-center">
                <div class="sidebar_icon d-lg-none">
                    <i class="ti-menu"></i>
                </div>
                <div class="line_icon open_miniSide d-none d-lg-block">
                    <!--<img src="img/line_img.png" alt>-->
                </div>
                <?php
                if ($_SESSION['role'] == 'User'){
                    echo '
                <div class="serach_field-area d-flex align-items-center">
                    <div class="search_inner">
                        <form action="shop.php" enctype="multipart/form-data" method="post">
                            <div class="search_field">
                                <input type="text" name="search" placeholder="Search">
                            </div>
                            <button type="submit" name="search_btn"> 
                                <img src="img/icon/icon_search.svg" alt> 
                            </button>
                        </form>
                    </div>
                </div>
                    ';
                }

                ?>
                <div class="header_right d-flex justify-content-between align-items-center">
                    <div class="profile_info">
                        <?php
                        if ($_SESSION['img'] == "")
                        {
                            echo '<img src="img/client_img.png">';
                        }
                        else
                        {
                            ?>
                            <img src="img/users/<?php echo $userCredentials['img']; ?>">
                            <?php
                        }
                        ?>
                        <div class="profile_info_iner">
                            <div class="profile_author_name">
                                <p>
                                    <?php echo $userCredentials['role']; ?>
                                </p>
                                <h5>
                                    <a href="profile.php" class="text_white">
                                        <?php echo $userCredentials['name']; ?>
                                    </a>
                                </h5>
                                <p>
                                    <?php
                                    if ($userCredentials['role'] == 'User')
                                    {
                                        echo "$ ".$userCredentials['wallet'];
                                    }
                                    else
                                    {
                                        echo "";
                                    }
                                    ?>
                                </p>
                            </div>
                            <div class="profile_info_details">
                                <a href="profile.php">My Profile </a>
                                <a href="settings.php">Settings</a>
                                <a href="logout.php">Log Out </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>