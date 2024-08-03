<?php
$recaptcha = $_POST['g-recaptcha-response'];
$secret_key = '6Lc9nxkpAAAAAC0SbnGAa2qqBXNKZ-suHVZFLHG-';
$url = 'https://www.google.com/recaptcha/api/siteverify?secret='
    . $secret_key . '&response=' . $recaptcha;

// Making request to verify captcha
$response = file_get_contents($url);

// Response return by google is in
// JSON format, so we have to parse
// that json
$response = json_decode($response);

// Checking, if response is true or not
if ($response->success == true) {
    $sql = mysqli_query($db, "SELECT * FROM users WHERE email = '$email' AND password = '$password' AND status = 'Active'");
    $row = mysqli_fetch_array($sql);
    $count = mysqli_num_rows($sql);
    if ($count > 0)
    {
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $row['name'];
        $_SESSION['img'] = $row['img'];
        $_SESSION['role'] = $row['role'];
        echo "<script>window.open('index.php','_self')</script>";
    }
    else
    {
        ?>
        <div class="alert text-white bg-primary d-flex align-items-center justify-content-between" style="margin-top: 20px; background: #BA704F!important;" role="alert">
            <div class="alert-text">
                <strong>Hi <?php echo $_POST['email']; ?>!</strong>
                Take An Error! Try Again.
            </div>
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                <i class="ti-close text-white f_s_14"></i>
            </button>
        </div>
        <?php
    }
} else {
    ?>
    <div class="alert text-white bg-primary d-flex align-items-center justify-content-between" style="margin-top: 20px; background: #BA704F!important;" role="alert">
        <div class="alert-text">
            <strong>Hi <?php echo $_POST['email']; ?>!</strong>
            Kindly verify! Are you human.
        </div>
        <button type="button" class="close btn_3" data-bs-dismiss="alert" aria-label="Close">
            <i class="ti-close text-white f_s_14" style="color: orange!important;"></i>
        </button>
    </div>
    <?php
}