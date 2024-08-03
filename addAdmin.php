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
                                            <h5 class="modal-title text_white">Add New Admin</h5>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post" enctype="multipart/form-data">
                                                <div class>
                                                    <input type="text" name="name" class="form-control" placeholder="Enter your Name" required>
                                                </div>
                                                <div class>
                                                    <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                                                </div>
                                                <div class>
                                                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                                                </div>

                                                <div class>
                                                    <select id="inputState" class="form-control" name="role" required>
                                                        <option value="" selected>Choose Role</option>
                                                        <option>Admin</option>
                                                        <option>User</option>
                                                    </select>
                                                </div>
                                                <button type="submit" name="register" class="btn_3 full_width text-center" style="width: 100%!important; margin-top: 20px;">
                                                    Add New Admin/User
                                                </button>
                                            </form>
                                            <?php
                                            if (isset($_POST['register']))
                                            {
                                                $name = mysqli_real_escape_string($db, $_POST['name']);
                                                $email = mysqli_real_escape_string($db, $_POST['email']);
                                                $password = mysqli_real_escape_string($db, $_POST['password']);
                                                $role = mysqli_real_escape_string($db, $_POST['role']);

                                                if ($name == "" && $email == "" && $password == "")
                                                {
                                                    echo "<script>alert('Please Fill the Name, Email and Password Fields First!')</script>";
                                                }
                                                else
                                                {
                                                    $sql = mysqli_query($db, "INSERT INTO `users`(`name`, `email`, `password`, `role`, `status`) VALUES ('$name', '$email', '$password', '$role', 'Active')");
                                                    if ($sql)
                                                    {
                                                        if ($role == 'Admin') {
                                                            echo "<script>alert('New Admin has been Added.')</script>";
                                                            echo "<script>window.open('admins.php','_self')</script>";
                                                        }
                                                        else
                                                        {
                                                            echo "<script>alert('New User has been Added.')</script>";
                                                            echo "<script>window.open('users.php','_self')</script>";
                                                        }
                                                    }
                                                    else
                                                    {
                                                        echo "<script>alert('Take an Error! Try Again.')</script>";
                                                        echo "<script>window.open('addAdmin.php','_self')</script>";
                                                    }
                                                }
                                            }
                                            ?>
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
