<?php
@error_reporting(E_ALL, ~E_NOTICE); 
ob_start(); 
ini_set("allow_url_include","Off"); 
ini_set("allow_url_fopen","Off"); 
ini_set("register_globals","Off"); 
ini_set("safe_mode","On");

// Подгрузка ядра ///////////////////////////////////////////////
require_once("../config.php");
require_once("../".SOURCE_DIR."/config_db.php");
require_once("../".SOURCE_DIR."/init_db.php");
require_once("../".SOURCE_DIR."/init_source.php");


$query_array=mysql_query("SELECT `uid`,`lipos` FROM `pars`"); 
 
if(mysql_num_rows($query_array)=="0") 
{ 
echo("Ошибка"); 
} 
while($row=mysql_fetch_array($query_array)) 
{ 


			$query=mysql_query("UPDATE `links` SET `pos`='".$row[1]."' WHERE `href`='".$row[0]."'");
} 

$update664=mysql_query("UPDATE `tables` SET `up`='0'");

?>