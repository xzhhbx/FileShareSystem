<?php
/*
 Author:AroRain(MoeLuoYu)
 This is free software,but you can use it for business.
 $ id: FileShareSystem_template 2022-4-10 CST MoeLuoYu $
*/
function xhtml_head()
{
    $name = NAME;
    $subname = SUBNAME;
    $icon = ICON;
    echo <<<XHTML
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head> 
  <title>{$name} {$subname}</title> 
  <link rel="shortcut icon" href="{$icon}" type="image/x-icon" /> 
  <link rel="stylesheet" href="./static/style/style.css" /> 
 </head> 
 <body> 
  <div id="header">
    {$name}
  </div>
 </body>
</html>
XHTML;
}

function xhtml_footer()
{
    $name = NAME;
    $urlsite = URLSITE;
    $cop = cop;
    $copyname = COPYNAME;
    echo <<<XHTML
<html>
 <head></head>
 <body>
  <div id="footer">
    &copy;2020-2022 <a href="{$urlsite}">{$copyname}</a> {$cop}
  </div>  
 </body>
</html>
XHTML;
}

?>
