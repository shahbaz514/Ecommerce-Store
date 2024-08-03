<?php
ob_start();
session_start();
include "db/db.php";
if (!isset($_SESSION['email']))
{
    header("Location: login.php");
}
$rowpro = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM products WHERE id = '".$_GET['view']."'"));

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
                        <div class="modal-content cs_modal">
                            <div class="modal-header theme_bg_1" style="background: #1d2c48!important;">
                                <h5 class="modal-title text_white">
                                    View Resources for Product: <span style="color: #fff8d5;"><?php echo $rowpro['name']; ?></span>
                                </h5>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <?php
                                    $sqlGet = mysqli_query($db, "SELECT * FROM product_uploads WHERE pro_id = '".$_GET['view']."'");
                                    while ($rowGet = mysqli_fetch_array($sqlGet))
                                    {
                                        ?>
                                        <div class="col-sm-6" style="margin-top: 10px; margin-bottom: 10px; padding: 10px;">

                                            <h5 style="color: #000; font-size: 17px; font-weight: 400;" class="text-center">
                                                <a href="uploads/orders/<?php echo $rowGet['name']; ?>" class="btn btn-primary">
                                                    <?php echo $rowGet['name']; ?>
                                                </a>
                                            </h5>

                                            <center>
                                                <a class="btn_2" href="viewProResources.php?view=<?php echo $_GET['view'] ?>&&del=<?php echo $rowGet['id']; ?>">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </center>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <div class="col-sm-12">
                                        <div class="row">

                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-6">

                                                <div class="modal-header theme_bg_1" style="background: #1d2c48!important;">
                                                    <h5 class="modal-title text_white">
                                                        Add More Resources for Product: <span style="color: #fff8d5;"><?php echo $rowpro['name']; ?></span>
                                                    </h5>
                                                </div>
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
                                                    $countStock = 0;
                                                    $countStock = mysqli_num_rows(mysqli_query($db, "SELECT * FROM `product_uploads` WHERE pro_id = '".$_GET['view']."' AND email = ''"));
                                                    $fileCount = count($_FILES["image"]['name']);
                                                    $i = 0;
                                                    for ($i = 0; $i < $fileCount; $i++) {
                                                        $RandomNum = time();

                                                        $ImageName = str_replace(' ', '-', strtolower($_FILES['image']['name'][$i]));
                                                        $ImageType = $_FILES['image']['type'][$i]; /*"image/png", image/jpeg etc.*/

                                                        $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
                                                        $ImageExt = str_replace('.', '', $ImageExt);
                                                        $ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
                                                        $NewImageName = rand() . '-' . $_GET['view'] . '-' . $RandomNum . '.' . $ImageExt;
                                                        move_uploaded_file($_FILES["image"]["tmp_name"][$i], "uploads/orders/" . $NewImageName);
                                                        mysqli_query($db, "INSERT INTO `product_uploads`(`name`, `pro_id`) VALUES ('$NewImageName', '".$_GET['view']."')");
                                                    }
                                                    $totalStock = $countStock + $fileCount;
                                                    $sqlUp = mysqli_query($db, "UPDATE products SET stack_qty = '$totalStock' WHERE id = '".$_GET['view']."'");
                                                    if ($sqlUp)
                                                    {
                                                        echo "<script>window.open('viewProResources.php?view=".$_GET['view']."', '_self')</script>";
                                                    }
                                                }
                                                if (isset($_GET['del']))
                                                {
                                                    $sqlDel = mysqli_query($db, "DELETE FROM product_uploads WHERE id = '".$_GET['del']."' AND pro_id = '".$_GET['view']."'");
                                                    if ($sqlDel)
                                                    {
                                                        $stack_qty = $rowpro['stack_qty']-1;
                                                        $sqlUpPro = mysqli_query($db, "UPDATE Products SET stack_qty = '$stack_qty' WHERE id = '".$_GET['view']."'");
                                                        if ($sqlUpPro)
                                                        {
                                                            echo "<script>window.open('viewProResources.php?view=".$_GET['view']."', '_self')</script>";
                                                        }
                                                    }
                                                }
                                                ?>
                                            </div>
                                            <div class="col-sm-3"></div>
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
<script>
    $(document).ready(function(){
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = '<div><input type="file" name="field_name[]" value=""/><a href="javascript:void(0);" class="remove_button btn_2"><i class="fas fa-minus"></i></a></div>'; //New input field html
        var x = 1; //Initial field counter is 1

        // Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){
                x++; //Increase field counter
                $(wrapper).append(fieldHTML); //Add field html
            }else{
                alert('A maximum of '+maxField+' fields are allowed to be added. ');
            }
        });

        // Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrease field counter
        });
    });
</script>