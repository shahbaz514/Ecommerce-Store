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
if (isset($_GET['del']))
{
    $del = $_GET['del'];
    $sqldel = mysqli_query($db, "DELETE FROM users WHERE id = '$del'");
    if ($sqldel)
    {
        echo "<script>window.open('admins.php','_self')</script>";
    }
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
                                        <h3 class="m-0">All Admins</h3>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="row justify-content-end">
                                        <div class="col-lg-8 d-flex justify-content-end">
                                            <a href="addAdmin.php" class="btn btn_4">
                                                <i class="fas fa-plus"></i>
                                            </a>
                                            <div class="serach_field-area theme_bg d-flex align-items-center">
                                                <div class="search_inner">
                                                    <form action="admins.php" enctype="multipart/form-data" method="post">
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
                                $sql = mysqli_query($db, "SELECT * FROM `users` WHERE name LIKE '%$search%' and role = 'Admin' ORDER BY name ASC");
                            }
                            else
                            {
                                $sql = mysqli_query($db, "SELECT * FROM `users` WHERE role = 'Admin' ORDER by name ASC");
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
                                    <a href="changepasswordadmin.php?id=<?php echo $row['id'] ?>&&name=<?php echo $row['name'] ?>" class="action_btn mr_10"> <i class="far fa-edit"></i> </a>
                                    <a href="admins.php?del=<?php echo $row['id'] ?>" class="action_btn"> <i class="fas fa-trash"></i> </a>
                                </div>
                            </div>
                            <?php
                            }
                            ?>
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