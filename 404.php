<?php
/*
 Author:AroRain(MoeLuoYu)
 This is free software,but you can use it for business.
 $ id: FileShareSystem_404page 2022-4-10 CST MoeLuoYu $
*/
require "./include/config.php";
$lang = LANG;
require "{$lang}";
$notfound = notfound;

xhtml_head("ERROR 404 !");

echo "<div class=\"error\">{$notfound}- ERROR 404 !</div>";

xhtml_footer();
?>
