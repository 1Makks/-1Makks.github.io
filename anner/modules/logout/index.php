<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");

echo("<title>Выход : ".$params_array[0]."</title>");
$_SESSION['uid']="";
$_SESSION['uip']="";
header("location: /index.php");
?>
