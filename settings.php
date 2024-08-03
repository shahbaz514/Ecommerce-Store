<?php
ob_start();
session_start();
include "db/db.php";
if (!isset($_SESSION['email']))
{
    header("Location: login.php");
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
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-10">
                        <div class="white_box_50px mb_30" style="padding: 20px; margin: 20px;">
                            <div class="row justify-content-center">
                                <div class="col-lg-6">
                                    <div class="modal-content cs_modal">
                                        <div class="modal-header theme_bg_1" style="background: #1d2c48!important;">
                                            <h5 class="modal-title text_white">Settings</h5>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post" enctype="multipart/form-data">
                                                <div class>
                                                    <input type="text" name="name" value="<?php echo $userCredentials['name']; ?>" class="form-control" placeholder="Name">
                                                </div>
                                                <div class>
                                                    <input type="number" name="phone" value="<?php echo $userCredentials['phone']; ?>" class="form-control" placeholder="Number">
                                                </div>
                                                <div class>
                                                    <input type="file" name="img" title="Select Profile Image" class="form-control" accept="image/*">
                                                </div>
                                                <button type="submit" name="edit" class="btn_3 full_width text-center" style="width: 100%!important;">
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

if (isset($_POST['edit']))
{
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $phone = mysqli_real_escape_string($db, $_POST['phone']);
    $temp = explode(".", $_FILES["img"]["name"]);
    $newfilename = $_SESSION['email'] . '.' . rand() . '.' . end($temp);
    if (empty($_FILES["img"]["name"]))
    {
        $update = mysqli_query($db, "UPDATE users SET name = '$name', phone = '$phone' WHERE email = '".$_SESSION['email']."' ");
        if ($update)
        {
            echo "<script>window.open('profile.php', '_self')</script>";
        }
    }
    else
    {
        $update = mysqli_query($db, "UPDATE users SET name = '$name', img = '$newfilename', phone = '$phone' WHERE email = '".$_SESSION['email']."' ");
        if ($update)
        {

            $move = move_uploaded_file($_FILES["img"]["tmp_name"], "img/users/" . $newfilename);
            if ($move)
            {
                echo "<script>window.open('profile.php', '_self')</script>";
            }

        }
    }
}
?>
