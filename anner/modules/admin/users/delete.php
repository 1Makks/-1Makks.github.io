<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");

$num_arr=mysql_fetch_array(mysql_query("SELECT `id` FROM `users` WHERE `id`='".$get_array['id']."'"));
if($num_arr[0]=="")
{
	msg("Нет записи с ID!","warning");
}
else
{	
	$query=mysql_query("DELETE FROM `users` WHERE `id`='".intval($get_array['id'])."'");
	if($query) header("location: /".$config['admin'].".php?page=users"); else msg("Ошибка при удалении записи!","warning");
}
?>