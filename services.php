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
    $sqldel = mysqli_query($db, "DELETE FROM services WHERE id = '$del'");
    if ($sqldel)
    {
        echo "<script>window.open('services.php','_self')</script>";
    }
}

if (isset($_GET['status']))
{
    $id = $_GET['status'];
    $sqlgetstatus = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM services WHERE id = '$id'"));
    $statusget = $sqlgetstatus['status'];
    if ($statusget == 'Active')
    {
        $update = mysqli_query($db, "UPDATE services SET status = 'Block' WHERE id = '$id'");
        if ($update)
        {
            echo "<script>window.open('services.php','_self')</script>";
        }
    }
    else
    {
        $update = mysqli_query($db, "UPDATE services SET status = 'Active' WHERE id = '$id'");
        if ($update)
        {
            echo "<script>window.open('services.php','_self')</script>";
        }
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
                                            <h3 class="m-0">All Services</h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="row justify-content-end">
                                            <div class="col-lg-8 d-flex justify-content-end">
                                                <a href="addService.php" class="btn btn_4">
                                                    <i class="fas fa-plus"></i>
                                                </a>
                                                <div class="serach_field-area theme_bg d-flex align-items-center">
                                                    <div class="search_inner">
                                                        <form action="services.php" enctype="multipart/form-data" method="post">
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
                                    $sql = mysqli_query($db, "SELECT * FROM `services` WHERE name LIKE '%$search%' ORDER BY id ASC");
                                }
                                else
                                {
                                    $sql = mysqli_query($db, "SELECT * FROM `services` ORDER by id ASC");
                                }
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
            </div>
        </div>

        <?php
        include "inc/footer.php";
        ?>
    </section>

<?php
include "inc/js_footer.php";
?>