<?php
ob_start();
session_start();
include "db/db.php";
if (!isset($_SESSION['email']))
{
    header("Location: login.php");
}
$rowpro = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM products WHERE id = '".$_GET['id']."'"));
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
                                            <h5 class="modal-title text_white">
                                                Add Product Resources for <span style="color: #fff8d5;"><?php echo $rowpro['name']; ?></span>
                                            </h5>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post" enctype="multipart/form-data">
                                                <div class>
                                                    <div class="field_wrapper">
                                                        <div>
                                                            <input type="file" name="image[]" class="form-control" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" name="save" class="btn_3 full_width text-center" style="width: 100%!important; margin-top: 20px;">
                                                    <i class="fas fa-save"></i>SAVE
                                                </button>
                                            </form>
                                            <?php
                                            if(isset($_POST['save'])){
                                                $fileCount = count($_FILES["image"]['name']);
                                                $i = 0;
                                                for ($i = 0; $i < $fileCount; $i++) {
                                                    $RandomNum = time();

                                                    $ImageName = str_replace(' ', '-', strtolower($_FILES['image']['name'][$i]));
                                                    $ImageType = $_FILES['image']['type'][$i]; /*"image/png", image/jpeg etc.*/

                                                    $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
                                                    $ImageExt = str_replace('.', '', $ImageExt);
                                                    $ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
                                                    $NewImageName = rand() . '-' . $_GET['id'] . '-' . $RandomNum . '.' . $ImageExt;
                                                    move_uploaded_file($_FILES["image"]["tmp_name"][$i], "uploads/orders/" . $NewImageName);
                                                    mysqli_query($db, "INSERT INTO `product_uploads`(`name`, `pro_id`) VALUES ('$NewImageName', '".$_GET['id']."')");
                                                }
                                                $sqlUp = mysqli_query($db, "UPDATE products SET stack_qty = '$i' WHERE id = '".$_GET['id']."'");
                                                if ($sqlUp)
                                                {
                                                    echo "<script>alert('Product Resources Uploaded Successfully')</script>";
                                                    echo "<script>window.open('products.php','_self')</script>";
                                                }
                                            }
                                            ?>
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
?>