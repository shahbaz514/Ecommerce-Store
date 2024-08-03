<?php
ob_start();
session_start();
include "db/db.php";
if (!isset($_SESSION['email']))
{
    header("Location: login.php");
}
$rowpro = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM orders WHERE id = '".$_GET['view']."'"));
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
                                    View Resources for Order ID: <span style="color: #fff8d5;"><?php echo $_GET['view']; ?></span>
                                </h5>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <?php
                                    $sqlGet = mysqli_query($db, "SELECT * FROM product_uploads WHERE orderid = '".$_GET['view']."'");
                                    while ($rowGet = mysqli_fetch_array($sqlGet))
                                    {
                                        ?>
                                        <div class="col-sm-6" style="margin-top: 10px; margin-bottom: 10px; padding: 10px;">

                                            <h5 style="color: #000; font-size: 17px; font-weight: 400;" class="text-center">
                                                <a href="download.php?path=<?php echo $rowGet['name']; ?>" class="btn_3" target="_blank">
                                                    <?php echo $rowGet['name']; ?>
                                                </a>
                                            </h5>

                                            <center>
                                                <a class="btn_2" href="download.php?path=<?php echo $rowGet['name']; ?>" target="_blank">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </center>
                                        </div>
                                        <?php
                                    }
                                    ?>
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