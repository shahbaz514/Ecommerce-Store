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
    $sqldel = mysqli_query($db, "DELETE FROM blog WHERE id = '$del'");
    if ($sqldel)
    {
        echo "<script>window.open('blogs.php','_self')</script>";
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
                                            <h3 class="m-0">All QAs/Blogs</h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="row justify-content-end">
                                            <div class="col-lg-8 d-flex justify-content-end">
                                                <a href="addblog.php" class="btn btn_4">
                                                    <i class="fas fa-plus"></i>
                                                </a>
                                                <div class="serach_field-area theme_bg d-flex align-items-center">
                                                    <div class="search_inner">
                                                        <form action="blogs.php" enctype="multipart/form-data" method="post">
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
                                            <th scope="col">Description</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Delete</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i = 0;
                                        if (isset($_POST['search_btn']))
                                        {
                                            $search = $_POST['search'];
                                            $sql = mysqli_query($db, "SELECT * FROM `blog` WHERE name LIKE '%$search%' ORDER BY id ASC");
                                        }
                                        else
                                        {
                                            $sql = mysqli_query($db, "SELECT * FROM `blog` ORDER by id ASC");
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
                                                    <?php echo $row['description']; ?>
                                                </td>
                                                <td class="f_s_12 f_w_400 color_text_6">
                                                    <?php
                                                    if (!empty($row['img']))
                                                    {
                                                        ?>
                                                        <a href="img/blogs/<?php echo $row['img']; ?>" target="_blank">
                                                            <img src="img/blogs/<?php echo $row['img']; ?>" style="width: 100px;">
                                                        </a>
                                                        <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td class="f_s_12 f_w_400 color_text_6">
                                                    <?php echo $row['email']; ?>
                                                </td>
                                                <td class="f_s_12 f_w_400 text-end">
                                                    <a href="blogs.php?del=<?php echo $row['id'] ?>" class="action_btn">
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