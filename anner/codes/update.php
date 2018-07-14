<?php
@error_reporting(E_ALL, ~E_NOTICE); 
ob_start(); 
ini_set("allow_url_include","Off"); 
ini_set("allow_url_fopen","Off"); 
ini_set("register_globals","Off"); 
ini_set("safe_mode","On");

// Подгрузка ядра
require_once("../config.php");
require_once("../source/config_db.php");
require_once("../source/init_db.php");
require_once("../source/init_source.php");

$hold1=mysql_fetch_array(mysql_query("SELECT `sid`,`price` FROM `abanner` WHERE STR_TO_DATE(  `lim` ,  '%d.%m.%Y %H:%i' )='".date("Y-m-d H:i")."' AND `hold`='1' "));
if($hold1!=0) 
{
$hold2=mysql_fetch_array(mysql_query("SELECT `uid` FROM `tables` WHERE `id`='".$hold1[0]."' "));

if($hold2!=0) 
{
$hold3=mysql_query("UPDATE `users` SET `hold`=hold-".round(floatval($hold1[1]),2)." WHERE `id`='".$hold2[0]."'");
$hold4=mysql_query("UPDATE `users` SET `balance`=balance+".round(floatval($hold1[1]),2)." WHERE `id`='".$hold2[0]."'");
$bal=mysql_fetch_array(mysql_query("SELECT `balance` FROM `users` WHERE `id`='".$hold2[0]."'"));		
$stat=mysql_query("INSERT INTO `statistic` VALUES (NULL,'".$hold2[0]."','6','".date("d.m.Y H:i")."','".floatval(round($hold1[1], 2))."','".$bal[0]."','0','0','0','0')");
}
}

$del=mysql_query("DELETE FROM `abanner` WHERE  STR_TO_DATE(  `lim` ,  '%d.%m.%Y %H:%i' )='".date("Y-m-d H:i")."'");
$del1=mysql_query("UPDATE `tables` SET `lastdate`='0' WHERE STR_TO_DATE(  `lastdate` ,  '%d.%m.%Y %H:%i' )='".date("Y-m-d H:i")."'");

// Завершаем работу mysql
mysql_close();

// Завершение работы
exit;
?>