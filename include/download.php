<?php
/*
 Author:AroRain(MoeLuoYu)
 This is free software,but you can use it for business.
 $ id: FileShareSystem_download 2022-4-10 CST MoeLuoYu $
*/
require "../include/config.php";
if (!isset($_GET['path'])) {
    header("Location: ../404.php");
    exit;
} elseif (($path = trim($_GET['path'])) == "") {
    header("Location: ../404.php");
    exit;
} elseif (!is_file($path) || !is_readable($path)) {
    header("Location: ../404.php");
    exit;
} else {
    $myfs = new filesystem($path);
    $info = $myfs->getpath();
    if (isset($_GET['mime']) && strlen($mime = trim($_GET['mime'])) >= 3) {
        header("Content-Type: $mime");
    } else {
        ___download($path);
        exit;
    }
    header("Accept-Ranges: bytes");
    header("Content-Length: " . $info['size']);
    $fp = fopen($path, "rb");
    while (!feof($fp)) {
        echo fread($fp, 4096);
    }
    fclose($fp);
}
?>
