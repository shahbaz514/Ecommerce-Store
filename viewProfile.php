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

if (isset($_GET['id']))
{
    $id = $_GET['id'];
    $sqlRow = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM users WHERE id = '$id'"));
}
else
{
    header("Location: index.php");
}
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
            <div class="container-fluid pt-4 px-4">
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="bg-light text-center rounded col-sm-6" >
                        <div class="rounded">
                            <div class="testimonial-item text-center">
                                <?php
                                if ($sqlRow['img'] == "")
                                {
                                    echo '<img class="rounded-circle" src="img/customers/1.png"  style="width: 200px; border: 2px solid #0dcaf0; padding: 2px; margin: 5px;">';
                                }
                                else
                                {
                                    echo '
                                    <a href="img/users/'.$sqlRow['img'].'" target="_blank">
                                        <img class="rounded-circle" src="img/users/'.$sqlRow['img'].'" style="width: 200px; border: 2px solid #0dcaf0; padding: 2px; margin: 5px;">
                                    </a>
                                    ';
                                }
                                ?>
                                <h5 class="text-uppercase"><?php echo $sqlRow['name']; ?></h5>
                                <?php
                                if ($sqlRow['role'] == "User")
                                {
                                    ?>
                                    <p class="text-center text-uppercase">
                                        Balance = <?php echo $sqlRow['wallet']; ?> USD
                                    </p>
                                    <?php
                                }
                                ?>
                                <table class="table text-start align-middle table-bordered table-hover mb-0">
                                    <tr>
                                        <th class="text-uppercase">Role:</th>
                                        <td><?php echo $sqlRow['role']; ?></td>
                                    </tr>
                                    <tr>
                                        <th class="text-uppercase">Email:</th>
                                        <td><?php echo $sqlRow['email']; ?></td>
                                    </tr>
                                    <tr>
                                        <th class="text-uppercase">Phone:</th>
                                        <td><?php echo $sqlRow['phone']; ?></td>
                                    </tr>
                                    <?php
                                    if ($sqlRow['role'] == "User")
                                    {
                                        ?>
                                        <tr>
                                            <th class="text-uppercase">Registration Date:</th>
                                            <td><?php echo $sqlRow['date']; ?></td>
                                        </tr>
                                        <tr>
                                            <th class="text-uppercase">Status:</th>
                                            <td><?php echo $sqlRow['status']; ?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                        <?php
                        if ($sqlRow['role'] != 'Admin')
                        {
                            ?>
                            <div class="row justify-content-center">
                                <div class="col-sm-12">
                                    <div class="white_box_50px mb_30" style="padding: 20px; margin: 20px;">
                                        <div class="modal-content cs_modal">
                                            <div class="modal-header theme_bg_1" style="background: #1d2c48!important;">
                                                <h5 class="modal-title text_white">Update User Balance</h5>
                                            </div>
                                            <div class="modal-body">
                                                <form action="" method="post" enctype="multipart/form-data">
                                                    <div class>
                                                        <input type="number" name="wallet" value="<?php echo $sqlRow['wallet']; ?>" class="form-control" placeholder="Enter Amount" required>
                                                    </div>
                                                    <button type="submit" name="save" class="btn_3 full_width text-center" style="width: max-content!important; margin-top: 20px;">
                                                        <i class="fas fa-save"></i> Update Balance
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="col-sm-3"></div>
                </div>
            </div>
        </div>

        <?php

        if (isset($_POST['save']))
        {
            $wallet = mysqli_real_escape_string($db, $_POST['wallet']);
            $sqlUpdate = mysqli_query($db, "UPDATE users SET wallet = '$wallet' WHERE email = '".$sqlRow['email']."'");
            if ($sqlUpdate)
            {
                echo "<script>alert('Balance has been Updated.')</script>";
                echo "<script>window.open('viewProfile.php?id=".$_GET['id']."','_self')</script>";
            }
        }

        include "inc/footer.php";
        ?>
    </section>

<?php
include "inc/js_footer.php";
?>