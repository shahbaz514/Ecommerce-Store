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
<div class="erroe_page_wrapper">
    <div class="errow_wrap">
        <div class="container text-center">
            <img src="img/bak_hovers/sad.png" alt>
            <div class="error_heading  text-center">
                <h3 class="headline font-danger theme_color_6">
                    Error Page
                </h3>
            </div>
            <div class="col-md-8 offset-md-2 text-center">
                <p>
                    The page you are attempting to reach is currently not available.
                    This may be because the page does not exist or has been moved.
                </p>
            </div>
            <div class="error_btn  text-center">
                <a class=" default_btn theme_bg_6 " href="index.php">Back Home</a>
            </div>
        </div>
    </div>
</div>


<?php
include "inc/js_footer.php";
?>
