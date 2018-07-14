<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");

echo("<title>Вебмастер : ".$params_array[0]."</title>");

if(auth===FALSE)
{
	msg("Для доступа к данной странице необходима авторизация или <a href='/registration.html'>регистрация</a>!","warning");
}
else
{
	$num_arr=mysql_fetch_array(mysql_query("SELECT `id` FROM `tables` WHERE `id`='".$get_array['id']."' AND `uid`='".$user_arr[0]."'"));
	if($num_arr[0]=="")
	{
		msg("Объявление с таким ID нет, либо не пренадлежит вам!","warning");
	}
	else
	{	
                            $count_arr=mysql_fetch_array(mysql_query("SELECT `num` FROM `users` WHERE `id`=".$user_arr[0].""));
                            $i=$count_arr[0]-1;
                            $insert1=mysql_query("UPDATE `users` SET `num`='".$i."' WHERE `id`='".$user_arr[0]."'");	
                            $sid1=mysql_fetch_array(mysql_query("SELECT `id` FROM `alink` WHERE `sid`=".$get_array['id'].""));
                            $sid2=mysql_fetch_array(mysql_query("SELECT `id` FROM `abanner` WHERE `sid`=".$get_array['id'].""));

if($sid1!=0 OR $sid2!=0)
{
msg("Вы не можете удалить витрину в которой есть реклама!","warning");
}
else
{	
                            $query=mysql_query("DELETE FROM `tables` WHERE `id`='".$get_array['id']."'");
		if($query) header("location: webmaster.html"); else msg("Ошибка при удалении записи!","warning");
}
	}
}
?>