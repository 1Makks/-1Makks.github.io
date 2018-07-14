<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");

$num_arr=mysql_fetch_array(mysql_query("SELECT `id` FROM `tickets` WHERE `id`='".$get_array['id']."'"));
if($num_arr[0]=="")
{
	msg("Нет записи с ID!","warning");
}
else
{	
	$query=mysql_query("DELETE FROM `tickets` WHERE `id`='".intval($get_array['id'])."'");
	if($query) header("location: /".$config['admin'].".php?page=tickets"); else msg("Ошибка при удалении записи!","warning");
}
?>