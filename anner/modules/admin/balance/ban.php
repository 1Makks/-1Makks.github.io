<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");

$num_arr=mysql_fetch_array(mysql_query("SELECT `id` FROM `outbalance` WHERE `id`='".$get_array['id']."'"));
if($num_arr[0]=="")
{
	msg("Объявление с таким ID нет!","warning");
}
else
{	
	$query=mysql_query("UPDATE `outbalance` SET `status`=3 WHERE `id`='".intval($get_array['id'])."'");
	if($query) header("location: /".$config['admin'].".php?page=balance"); else msg("Ошибка при удалении записи","warning");
}
?>