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
$rowpro = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM products WHERE id = '".$_GET['edit']."'"));
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
                                            <h5 class="modal-title text_white">Edit Product: <span><?php echo $rowpro['name']; ?></span></h5>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post" enctype="multipart/form-data">
                                                <div class>
                                                    <input type="text" name="name" class="form-control" value="<?php echo $rowpro['name']; ?>" placeholder="Name" required>
                                                </div>
                                                <div class>
                                                    <input type="number" name="price" class="form-control" value="<?php echo $rowpro['price']; ?>" placeholder="Price" required>
                                                </div>
                                                <div class>
                                                    <textarea name="description" class="form-control" rows="5" placeholder="Description" required><?php echo $rowpro['description']; ?></textarea>
                                                </div>
                                                <div class>
                                                    <select id="inputState" class="form-control" name="service_id" required>
                                                        <option value="" selected>Choose Service Category</option>
                                                        <?php
                                                         $sql = mysqli_query($db, "SELECT * FROM `services` ORDER by id ASC");
                                                         while ($row = mysqli_fetch_array($sql))
                                                         {
                                                             ?>
                                                             <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                                             <?php
                                                         }
                                                        ?>
                                                    </select>
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
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $price = mysqli_real_escape_string($db, $_POST['price']);
    $description = mysqli_real_escape_string($db, $_POST['description']);
    $service_id = mysqli_real_escape_string($db, $_POST['service_id']);
    $update = mysqli_query($db, "UPDATE `products` SET `name`='$name',`price`='$price',`description`='$description',`service_id`='$service_id' WHERE id = '".$_GET['edit']."'");
    if ($update)
    {
        echo "<script>window.open('products.php', '_self')</script>";
    }
}
?>
