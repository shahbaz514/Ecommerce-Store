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
if (isset($_GET['del']))
{
    $del = $_GET['del'];
    $sqldel = mysqli_query($db, "DELETE FROM products WHERE id = '$del'");
    if ($sqldel)
    {
        echo "<script>alert('Product Has Been Deleted!')</script>";
        echo "<script>window.open('products.php','_self')</script>";
    }
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
                                            <h3 class="m-0">All Products</h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="row justify-content-end">
                                            <div class="col-lg-8 d-flex justify-content-end">
                                                <a href="addProduct.php" class="btn btn_4">
                                                    <i class="fas fa-plus"></i>
                                                </a>
                                                <div class="serach_field-area theme_bg d-flex align-items-center">
                                                    <div class="search_inner">
                                                        <form action="products.php" enctype="multipart/form-data" method="post">
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
                                            <th scope="col">Sr. No.</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Stuck QTY</th>
                                            <th scope="col">Service Category</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">View/Edit Resources</th>
                                            <th scope="col">Edit</th>
                                            <th scope="col">Delete</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i = 0;
                                        if (isset($_POST['search_btn']))
                                        {
                                            $search = $_POST['search'];
                                            $sql = mysqli_query($db, "SELECT * FROM `products` WHERE name LIKE '%$search%' ORDER BY id DESC");
                                        }
                                        else
                                        {
                                            $sql = mysqli_query($db, "SELECT * FROM `products` ORDER by id DESC");
                                        }
                                        while ($row = mysqli_fetch_array($sql))
                                        {
                                            $i = $i + 1;
                                            ?>
                                            <tr>
                                                <td class="f_s_12 f_w_400 color_text_6">
                                                    <?php echo $i; ?>
                                                </td>
                                                <td class="f_s_12 f_w_400 color_text_6">
                                                    <?php echo $row['name']; ?>
                                                </td>
                                                <td class="f_s_12 f_w_400 color_text_7">
                                                    <?php echo $row['price']; ?>
                                                </td>
                                                <td class="f_s_12 f_w_400 color_text_6">
                                                    <?php echo $row['stack_qty']; ?>
                                                </td>
                                                <td class="f_s_12 f_w_400 color_text_6">
                                                    <?php
                                                    $rowservice =  mysqli_fetch_array(mysqli_query($db, 'SELECT name FROM services WHERE id = "'.$row['service_id'].'"'));
                                                    echo $rowservice['name'];
                                                    ?>
                                                </td>
                                                <td class="f_s_12 f_w_400 color_text_6">

                                                    <?php echo $row['description']; ?>
                                                    <div class="single-pro-detail">
                                                        <ul class="list-unstyled pro-features border-0">
                                                            <?php
                                                            $sqlProFeatures = mysqli_query($db, "SELECT * FROM `products_features` WHERE pro_id = '".$row['id']."'");
                                                            while ($rowProFeatures = mysqli_fetch_array($sqlProFeatures))
                                                            {
                                                                echo '<li>'.$rowProFeatures['name'].'</li>';
                                                            }
                                                            //<a href="editFeature.php?edit='.$rowProFeatures['id'].'" class="btn_2"><i class="fas fa-edit"></i></a>
                                                            ?>
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td class="f_s_12 f_w_400 text-end">
                                                    <a href="viewProResources.php?view=<?php echo $row['id'] ?>" class="action_btn">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                                <td class="f_s_12 f_w_400 text-end">
                                                    <a href="editProduct.php?edit=<?php echo $row['id'] ?>" class="action_btn">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </td>
                                                <td class="f_s_12 f_w_400 text-end">
                                                    <a href="products.php?del=<?php echo $row['id'] ?>" class="action_btn">
                                                        <i class="fas fa-trash"></i>
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