<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");

$query=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM `banners` WHERE `id`='".intval($get_array['id'])."'"));
if($query[0]=="0") 
{ 
msg("Баннер с таким ID не найдена!","warning"); 
} 
else 
{ 
$delete=mysql_query("DELETE FROM `banners` WHERE `id`='".intval($get_array['id'])."'");
if($delete) header("location: /".$config['admin'].".php?page=banners"); 
else 
msg("Невозможно занести данные в базу данных!","warning");
} ?> 