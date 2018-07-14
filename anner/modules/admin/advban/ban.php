<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");

$num_arr=mysql_fetch_array(mysql_query("SELECT `id` FROM `abanner` WHERE `id`='".$get_array['id']."'"));
if($num_arr[0]=="")
{
	msg("Объявление с таким ID нет!","warning");
}
else
{	
	$query=mysql_query("UPDATE `abanner` SET `status`=3 WHERE `id`='".intval($get_array['id'])."'");
	if($query) header("location: /".$config['admin'].".php?page=advban"); else msg("Ошибка при удалении записи","warning");
}
?>