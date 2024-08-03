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
            <div class="container-fluid p-0 ">

                <div class="row ">
                    <div class="col-xl-12">
                        <div class="white_card card_height_100 mb_30">
                            <div class="white_card_header">
                                <div class="row align-items-center">
                                    <div class="col-lg-4">
                                        <div class="main-title">
                                            <h3 class="m-0">All Payments</h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="row justify-content-end">
                                            <div class="col-lg-8 d-flex justify-content-end">
                                                <div class="serach_field-area theme_bg d-flex align-items-center">
                                                    <div class="search_inner">
                                                        <form action="payments.php" enctype="multipart/form-data" method="post">
                                                            <div class="search_field">
                                                                <input type="text" placeholder="Search" name="search">
                                                            </div>
                                                            <button type="submit" name="search_btn">
                                                                <img src="img/icon/icon_search.svg" alt>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="white_card_body ">

                                <div class="QA_table ">

                                    <table class="table lms_table_active2 p-0">
                                        <thead>
                                        <tr>
                                            <th scope="col">Invoice No.</th>
                                            <th scope="col">User Email</th>
                                            <th scope="col">Total Amount</th>
                                            <th scope="col">Payment Date</th>
                                            <th scope="col">Payment Method</th>
                                            <th scope="col">Payment Proof</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i = 0;
                                        if (isset($_POST['search_btn']))
                                        {
                                            $search = $_POST['search'];
                                            $sql = mysqli_query($db, "SELECT * FROM `credits` WHERE email = '$search' OR invoice_no = '$search' ORDER BY id DESC");
                                        }
                                        else
                                        {
                                            $sql = mysqli_query($db, "SELECT * FROM `credits` ORDER by id DESC");
                                        }
                                        while ($row = mysqli_fetch_array($sql))
                                        {
                                            $i = $i + 1;
                                            ?>
                                            <tr>
                                                <td class="f_s_12 f_w_400 color_text_6">
                                                    <?php echo $row['invoice_no']; ?>
                                                </td>
                                                <td class="f_s_12 f_w_400 color_text_6">
                                                    <?php echo $row['email']; ?>
                                                </td>
                                                <td class="f_s_12 f_w_400 color_text_6">
                                                    <?php echo $row['total_amount']; ?>
                                                </td>
                                                <td class="f_s_12 f_w_400 color_text_6">
                                                    <?php echo $row['payment_date']; ?>
                                                </td>
                                                <td class="f_s_12 f_w_400 color_text_6">
                                                    <?php echo $row['payment_method']; ?>
                                                </td>
                                                <td class="f_s_12 f_w_400 color_text_6">
                                                    <a href="download.php?pathPayment=<?php echo $row['prof']; ?>" class="btn_3" target="_blank">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                                <td class="f_s_12 f_w_400 color_text_6">
                                                    <?php echo $row['date']; ?>
                                                </td>
                                                <td class="f_s_12 f_w_400 text-end">
                                                    <a href="paymentsVerification.php?status=<?php echo $row['invoice_no'] ?>" class="action_btn">
                                                        <?php
                                                        if ($row['status'] == "Verified")
                                                        {
                                                            echo '<i class="fas fa-check"></i>';
                                                        }
                                                        else
                                                        {
                                                            echo '<i class="fas fa-times"></i>';
                                                        }
                                                        ?>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
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