<?php
ob_start();
session_start();
include "db/db.php";
if (!isset($_SESSION['email']))
{
    header("Location: login.php");
}
include "inc/head.php";
$error = "";
?>
<body class="crm_body_bg">

<?php
include "inc/sidebar.php";
?>

<section class="main_content dashboard_part large_header_bg">

    <?php
    include "inc/navbar.php";
    $sqlGetFAQ = mysqli_query($db, "SELECT * FROM blog WHERE id = '".$_GET['id']."'");
    $rowGetFAQ = mysqli_fetch_array($sqlGetFAQ);
    ?>

    <div class="main_content_iner overly_inner ">
        <div class="container-fluid p-0 ">
            <div class="row ">
                <div class="main_content_iner ">
                    <div class="container-fluid p-0 sm_padding_15px">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="card_box box_shadow">
                                    <div class="box_body">
                                        <div class="default-according">
                                            <div class="card">
                                                <div class="card-header" style="background: #6C3428!important;">
                                                    <h5 class="mb-0">
                                                        <button class="btn text_white">
                                                            <i class="fas fa-question"></i>
                                                            <?php echo $rowGetFAQ['name']; ?>
                                                        </button>
                                                    </h5>
                                                </div>
                                                <div>
                                                    <div class="card-body">
                                                        <?php
                                                        if (!empty($rowGetFAQ['img']))
                                                        {
                                                            ?>
                                                            <center>
                                                                <img src="img/blogs/<?php echo $rowGetFAQ['img']; ?>" class="img-thumbnail img-responsive">
                                                            </center>
                                                            <?php
                                                        }
                                                        ?>

                                                        <p style="text-align: justify;">
                                                            <?php echo $rowGetFAQ['description']; ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
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

