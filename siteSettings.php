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
$rowpro = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM athentication WHERE id = '1'"));
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
                                <div class="col-lg-12">
                                    <div class="modal-content cs_modal">
                                        <div class="modal-header theme_bg_1" style="background: #1d2c48!important;">
                                            <h5 class="modal-title text_white">
                                                Site Settings
                                            </h5>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post" enctype="multipart/form-data">
                                                <div class>
                                                    <label for="">Site Name</label>
                                                    <input type="text" name="site_name" class="form-control" value="<?php echo $rowpro['site_name']; ?>" required>
                                                </div>
                                                <div class>
                                                    <label for="">Select Site Logo</label>
                                                    <input type="file" name="img" class="form-control">
                                                </div>
                                                <div class>
                                                    <label for="">Site Notification</label>
                                                    <textarea name="site_notice" class="form-control" rows="10" style="height: max-content!important;" required><?php echo $rowpro['site_notice']; ?></textarea>
                                                </div>
                                                <button type="submit" name="save" class="btn_3 full_width text-center" style="width: 100%!important; margin-top: 20px;">
                                                    <i class="fas fa-save"></i>SAVE
                                                </button>
                                            </form>
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

if (isset($_POST['save']))
{
    $site_name = mysqli_real_escape_string($db, $_POST['site_name']);
    $site_notice = mysqli_real_escape_string($db, $_POST['site_notice']);
    $temp = explode(".", $_FILES["img"]["name"]);
    $newfilename = rand() . '.' . end($temp);
    if (empty($_FILES["img"]["name"]))
    {
        $update = mysqli_query($db, "UPDATE `athentication` SET `site_name`='$site_name',`site_notice`='$site_notice' WHERE id = '1'");
        if ($update)
        {
            echo "<script>window.open('index.php', '_self')</script>";
        }
    }
    else
    {
        $update = mysqli_query($db, "UPDATE `athentication` SET `site_name`='$site_name',`site_logo`='$newfilename',`site_notice`='$site_notice' WHERE id = '1'");
        if ($update)
        {
            $move = move_uploaded_file($_FILES["img"]["tmp_name"], "img/site/" . $newfilename);
            if ($move)
            {
                echo "<script>window.open('index.php', '_self')</script>";
            }

        }
    }
}
?>
