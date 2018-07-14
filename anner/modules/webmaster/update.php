<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");

echo("<title>Вебмастер : ".$params_array[0]."</title>");

if(auth===FALSE)
{
	msg("Для доступа к данной странице необходима авторизация или <a href='/registration.html'>регистрация</a>!","warning");
}
else
{
	$num_arr=mysql_fetch_array(mysql_query("SELECT `id`,`up` FROM `tables` WHERE `id`='".$get_array['id']."' AND `uid`='".$user_arr[0]."'"));
	if($num_arr[0]=="")
	{
		msg("Объявление с таким ID нет, либо не пренадлежит вам!","warning");
	}
	else
	{	
if($num_arr[1]==1)
{
msg("Обновлять статистику, возможно ни чаще одного раза в день!","warning");
}
else
{
		$query=mysql_query("UPDATE `tables` SET `update`='0' WHERE `id`='".$get_array['id']."' AND `uid`='".$user_arr[0]."'");
		$query1=mysql_query("UPDATE `tables` SET `up`='0' WHERE `id`='".$get_array['id']."' AND `uid`='".$user_arr[0]."'");
		if($query)  msg("Статистика успешно обновлена!","warning"); else msg("Ошибка при изменении!","warning");
}
          }

}

?>