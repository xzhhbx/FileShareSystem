<?php
/*
 Author:AroRain(MoeLuoYu)
 This is free software,but you can use it for business.
 $ id: FileShareSystem_essentials 2022-4-10 CST MoeLuoYu $
*/
function ___codepre()
{
    $str = func_get_arg(0);
    if (func_num_args() > 1) {
        $arr1 = array("&", "\"", "'", "<", ">", '"');
        $arr2 = array("&amp;", "&quot;", "&apos;", "&lt;", "&gt;", "&#039;");
    } else {
        $arr1 = array("&", "\"", "'", "<", ">", " ", '"');
        $arr2 = array("&amp;", "&quot;", "&apos;", "&lt;", "&gt;", "&ensp;", "&#039;");
    }
    return str_replace($arr1, $arr2, $str);
}

function ___convert()
{
    $str = func_get_arg(0);
    $encode = func_num_args() < 2 ? "UTF-8" : func_get_arg(1);
    $enlist = func_num_args() > 2 ? func_get_arg(2) : "auto,CP936";
    return mb_convert_encoding($str, $encode, $enlist);
}
//获取文件类型
function ___getmime()
{
    $path = trim(func_get_arg(0));
    if (func_num_args() >= 2) {
        $type = trim(func_get_arg(1));
        $type = explode(':', $type);
    }
    if (!is_file($path)) return false;
    if (!($fp = fopen($path, "rb"))) return false;
    $bsupport = array(
        array('jpg', 'ffd8ff', 'image/jpeg'),
        array('png', '89504e47', 'image/png'),
        array('gif', '47494638', 'image/gif'),
        array('bmp', '424d', 'image/x-ms-bmp'));
    $headstr = bin2hex(fread($fp, 4));
    fclose($fp);
    foreach ($bsupport as $temp) {
        if (preg_match("/^$temp[1]/i", $headstr)) {
            if (!isset($type)) {
                return $temp[2];
            } elseif (in_array($temp[0], $type)) {
                return $temp[2];
            }
        }
    }
    return false;
}
//下载请求
function ___download()
{
    $path = trim(func_get_arg(0));
    $size = filesize($path);
    (isset($_SERVER['HTTP_RANGE']) && !empty($_SERVER['HTTP_RANGE']) && $range = substr($_SERVER['HTTP_RANGE'], 6)) || $range = '0-' . ($size - 1);
    if (substr($range, -1) == '-') {
        $init = substr($range, 0, -1);
        $stop = $size - 1;
    } elseif (substr($range, 0, 1) == '-') {
        $init = $size - substr($range, 1) - 1;
        $stop = $size - 1;
    } else {
        $init_stop = explode('-', $range);
        $init = $init_stop[0];
        $stop = $init_stop[1];
    }
    if (isset($_SERVER['HTTP_RANGE'])) {
        header('HTTP/1.1 206 Partial Content');
    }
    header('Accept-Ranges: bytes');
    header('Content-Type: application/force-download');
    header('Content-Disposition: attachment; filename=' . ___basename($path));
    header("Content-Range: bytes $init-$stop/$size");
    header('Content-Length: ' . ($stop - $init + 1));
    $fp = fopen($path, "rb");
    fseek($fp, $init);
    while (!feof($fp)) {
        echo fread($fp, 4096);
        if (ftell($fp) > $stop) {
            break;
        }
    }
    fclose($fp);
}
//文件目录
function ___basename()
{
    $path = trim(func_get_arg(0));
    $path = str_replace("\\", "/", $path);
    $path = explode("/", $path);
    return ___convert($path[count($path) - 1]);
}
//未使用但已实现 可以调用
function ___realpath()
{
    $path = func_get_arg(0);
    $path = str_replace('\\', '/', $path);
    if (!is_link($path)) return realpath($path);
    return preg_replace('/[^:]?\/{2,}/si', '/', $path);
}
//文件大小
function ___filesize()
{
    $size = trim(func_get_arg(0));
    if ($size < 1024) {
        return $size . " B";
    } elseif ($size < 1024 * 1024) {
        return number_format($size / 1024, 3) . " KB";
    } elseif ($size < 1024 * 1024 * 1024) {
        return number_format($size / 1024 / 1024, 3) . " MB";
    } elseif ($size < 1024 * 1024 * 1024 * 1024) {
        return number_format($size / 1024 / 1024 / 1024, 3) . " GB";
    } else {
        return number_format($size / 1024 / 1024 / 1024 / 1024, 3) . " TB";
    }
}
//短的文件地址
function ___shortpath()
{
    $path = trim(func_get_arg(0));
    $path = ___convert($path, "UTF-8");
    if (function_exists('mb_strlen')) {
        if (mb_strlen($path, "UTF-8") <= 18) return $path;
    } else {
        if (strlen($path) <= 18) return $path;
    }
    $path1 = function_exists('mb_substr') ? mb_substr($path, -9, 9, "UTF-8") : substr($path, -9);
    $path2 = function_exists('mb_substr') ? mb_substr($path, 0, 9, "UTF-8") : substr($path, 0, 9);
    return $path1;
}

?>
