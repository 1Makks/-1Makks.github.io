<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен");

$query=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM `links` WHERE `id`='".intval($get_array['id'])."'"));
if($query[0]=="0") 
{ 
msg("Новость с таким ID не найдена","warning"); 
} 
else 
{ 
$delete=mysql_query("DELETE FROM `links` WHERE `id`='".intval($get_array['id'])."'");
if($delete) header("location: /".$config['admin'].".php?page=links"); 
else 
msg("Невозможно занести данные в базу данных","warning");
} ?> 