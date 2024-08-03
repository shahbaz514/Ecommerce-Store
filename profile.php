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
            <div class="container-fluid pt-4 px-4">
                <div style="height: 480px" class="row rounded align-items-center justify-content-center mx-0">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                        <div class="rounded bg-light">
                            <div class="testimonial-item text-center">
                                <?php
                                if ($userCredentials['img'] == "")
                                {
                                    echo '<img class="rounded-circle" src="img/customers/1.png"  style="width: 200px; border: 2px solid #6C3428; padding: 2px; margin: 5px;">';
                                }
                                else
                                {
                                    echo '<a href="img/users/'.$userCredentials['img'].'" target="_blank"><img class="rounded-circle" src="img/users/'.$userCredentials['img'].'" style="width: 200px; border: 2px solid #6C3428; padding: 2px; margin: 5px;"></a>';
                                }
                                ?>
                                <h4 class="text-uppercase"><?php echo $userCredentials['name']; ?></h4>
                                <?php
                                if ($_SESSION['role'] == "User")
                                {
                                    ?>
                                    <p class="text-center text-uppercase" style="color: #6C3428; font-weight: bold;">
                                        Balance = <?php echo $userCredentials['wallet']; ?> USD
                                    </p>
                                    <?php
                                }
                                ?>
                                <table class="table text-start align-middle table-bordered table-hover mb-0">
                                    <tr>
                                        <th class="text-uppercase">Role:</th>
                                        <td><?php echo $userCredentials['role']; ?></td>
                                    </tr>
                                    <tr>
                                        <th class="text-uppercase">Email:</th>
                                        <td><?php echo $userCredentials['email']; ?></td>
                                    </tr>
                                    <tr>
                                        <th class="text-uppercase">Phone:</th>
                                        <td><?php echo $userCredentials['phone']; ?></td>
                                    </tr>
                                    <?php
                                    if ($_SESSION['role'] == "User")
                                    {
                                        ?>
                                        <tr>
                                            <th class="text-uppercase">Registration Date:</th>
                                            <td><?php echo $userCredentials['date']; ?></td>
                                        </tr>
                                        <tr>
                                            <th class="text-uppercase">Status:</th>
                                            <td><?php echo $userCredentials['status']; ?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="2">
                                            <center>
                                                <a href="settings.php" class="btn btn_3">
                                                    <i class="fa fa-edit"></i> Settings
                                                </a>
                                                <a href="changepassword.php" class="btn btn_3">
                                                    <i class="fa fa-user-secret"></i> Change Password
                                                </a>
                                            </center>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3"></div>
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