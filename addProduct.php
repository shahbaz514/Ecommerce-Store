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
                                            <h5 class="modal-title text_white">Add New Product</h5>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post" enctype="multipart/form-data">
                                                <div class>
                                                    <input type="text" name="name" class="form-control" placeholder="Name" required>
                                                </div>
                                                <div class>
                                                    <input type="number" name="price" class="form-control" placeholder="Price" required>
                                                </div>
                                                <div class>
                                                    <label for="">Product Description</label>
                                                    <textarea name="description" class="form-control" rows="5" placeholder="Description" required></textarea>
                                                </div>
                                                <div class="field_wrapper">
                                                    <div>
                                                        <label for="">Product Features</label>
                                                        <input type="text" name="field_name[]" value=""/>
                                                        <a href="javascript:void(0);" class="add_button btn_2" title="Add field">
                                                            <i class="fas fa-plus"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div style="margin-top: 20px;">
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
    $service_id = mysqli_real_escape_string($db, $_POST['service_id']);
    $description = mysqli_real_escape_string($db, $_POST['description']);
    $update = mysqli_query($db, "INSERT INTO `products`(`name`, `price`, `description`, `service_id`) VALUES ('$name', '$price', '$description', '$service_id')");
    if ($update)
    {
        $rowproid = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM products ORDER BY id DESC"));
        $proid = $rowproid['id'];
        $field_values_array = $_POST['field_name'];
        foreach($field_values_array as $value){
            mysqli_query($db, "INSERT INTO `products_features`(`name`, `pro_id`) VALUES ('$value', '$proid')");
        }
        echo "<script>window.open('productDescription.php?id=".$proid."', '_self')</script>";
    }
}
?>

<script>
    $(document).ready(function(){
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = '<div><input type="text" name="field_name[]" value=""/><a href="javascript:void(0);" class="remove_button btn_2"><i class="fas fa-minus"></i></a></div>'; //New input field html
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