<?php
@ob_start();
@session_start();
$im=imagecreate(60,30);
imagefill($im,0,0,imagecolorallocate($im,50,50,50));
$c1=substr(md5(rand(111,999)),0,3);
$c2=substr(md5(rand(111,999)),0,3);
$_SESSION['captcha']=$c1.$c2;
imagestring($im,rand(3,4),rand(5,8),rand(5,7),$c1,imagecolorallocate($im,150,150,150));
imagestring($im,rand(3,4),rand(30,28),rand(5,7),$c2,imagecolorallocate($im,150,150,150));
imageline($im,0,rand(11,20),60,rand(5,20),imagecolorallocate($im,150,150,150));
imagepng($im);
header("Content-type: /image/png");
?>
