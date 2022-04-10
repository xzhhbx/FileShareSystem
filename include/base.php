<?php
/*
 Author:AroRain(MoeLuoYu)
 This is free software,but you can use it for business.
 $ id: FileShareSystem_base 2022-4-10 CST MoeLuoYu $
*/
class filesystem {
    private $path = null;
    function __construct() {
        if (func_num_args() > 0) $this->path = func_get_arg(0);
    }
    function chpath() {
        if (func_num_args() < 1) {
            return false;
        } else {
            $this->path = func_get_arg(0);
        }
    }
    function getpath() {
        if (func_num_args() > 0) {
            $path = func_get_arg(0);
        } else {
            $path = $this->path;
        }
        if (is_dir($path)) {
            $fs = array(array(), array(), array());
            if (!($dh = opendir($path))) return false;
            while (($entry = readdir($dh)) !== false) {
                if ($entry != "." && $entry != "..") {
                    if (is_dir($entry = ($path . "/" . $entry))) {
                        $fs[0][] = $entry;
                    } elseif (is_file($entry)) {
                        $fs[1][] = $entry;
                    } else {
                        if ($entry != "") {
                            $fs[2][] = $entry;
                        }
                    }
                }
            }
            closedir($dh);
            if ((count($fs, 1) - 3) < 1) return null;
            if (count($fs[0]) > 0) usort($fs[0], "___sortcmp");
            if (count($fs[1]) > 0) usort($fs[1], "___sortcmp");
            if (count($fs[2]) > 0) usort($fs[2], "___sortcmp");
            return $fs;
        } elseif (file_exists($path)) {
            if (!($fs = stat($path))) {
                return false;
            } else {
                return $fs;
            }
        } else {
            return false;
        }
    }
    function getfinfo() {
        if (!function_exists("finfo_open")) return false;
        $finfo = finfo_open();
        if (func_num_args() > 0) {
            return finfo_file($finfo, func_get_arg(0));
        }
        return finfo_file($finfo, $this->path);
    }
}
?>
