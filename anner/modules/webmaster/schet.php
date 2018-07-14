<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");

echo("<title>Витрины : ".$params_array[0]."</title>");

if(auth===FALSE)
{
	msg("Для доступа к данной странице необходима авторизация или <a href='/registration.html'>регистрация</a>!","warning");
}
else
{


$num_arr=mysql_fetch_array(mysql_query("SELECT `id`,`schet`,`t` FROM `tables` WHERE `id`='".intval($get_array['id'])."' AND `uid`='".$user_arr[0]."'"));

	if($num_arr[1]=="0" OR $num_arr[0]=="")
	{
		msg("Ошибка","warning");
	}
	else
			{
if($num_arr[2]=="1")
{
				$update=mysql_query("UPDATE `tables` SET `schet`='0' WHERE `id`='".$num_arr[0]."'");
				if($update) header("location: webmaster.html&sub=statl&id=".$num_arr[0].""); else msg("Ошибка при записи в базу данных","warning");
}
if($num_arr[2]=="2")
{
				$update=mysql_query("UPDATE `tables` SET `schet`='0' WHERE `id`='".$num_arr[0]."'");
				if($update) header("location: webmaster.html&sub=statb&id=".$num_arr[0].""); else msg("Ошибка при записи в базу данных","warning");
}
			}
}
?>