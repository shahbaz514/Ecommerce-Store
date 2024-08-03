<?php
ob_start();
session_start();
include "db/db.php";
if (!isset($_SESSION['email']))
{
    header("Location: login.php");
}

if(isset($_GET['path']))
{
    $filename = "uploads/orders/".$_GET['path'];
    if(file_exists($filename)) {

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: 0");
        header('Content-Disposition: attachment; filename="'.basename($filename).'"');
        header('Content-Length: ' . filesize($filename));
        header('Pragma: public');
        flush();
        readfile($filename);
        die();
    }
    else{
        header("Location: index.php");
    }
}
else if(isset($_GET['pathPayment']))
{
    $filename = "img/payments/".$_GET['pathPayment'];
    if(file_exists($filename)) {

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: 0");
        header('Content-Disposition: attachment; filename="'.basename($filename).'"');
        header('Content-Length: ' . filesize($filename));
        header('Pragma: public');
        flush();
        readfile($filename);
        die();
    }
    else{
        header("Location: index.php");
    }
}
else{
    header("Location: index.php");
}

?>