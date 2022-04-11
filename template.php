<?php
/*
 Author:AroRain(MoeLuoYu)
 This is free software,do not use it for business.
 $ id: FileShareSystem_template 2022-4-11 CST MoeLuoYu $
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
    $copyear = COPYEAR;
    echo <<<XHTML
<html>
 <head></head>
 <body>
  <div id="footer">
    &copy;{$copyear} <a href="{$urlsite}">{$copyname}</a> {$cop}
  </div>  
 </body>
</html>
XHTML;
}

?>
