<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");

echo("<title>Вебмастер : ".$params_array[0]."</title>");

if(auth===FALSE)
{
	msg("Для доступа к данной странице необходима авторизация или <a href='/registration.html'>регистрация</a>!","warning");
}
else
{






echo("<b>Ваша площадка</b><br><br>
<table class='ap_list_table'>
	<tr>
		<td class='ap_list_table_td'>Поле</td>
		<td class='ap_list_table_td'>Содержимое</td>
</tr>");
$site_arr=mysql_query("SELECT `url`,`t`,`price`,`linknum`,`defban`,`maxtext`,`w`,`d`,`name`,`holdv` FROM `tables` WHERE `id`='".intval($get_array['id'])."' AND `uid`='".$user_arr[0]."'");
if(mysql_num_rows($site_arr)=="0")
echo("
<tr>
	<td colspan='3'>Ошибка</td>
</tr>");
while($row=mysql_fetch_array($site_arr))
{

if($row[1]==2)
{
echo("
<tr><td>Название</td><td>".$row[8]."</td></tr>
<tr><td>URL</td><td><a href='".$row[0]."' target='_blank'>".$row[0]."</a></td></tr>
<tr><td>Цена</td><td>".$row[2]." руб.</td></tr>
<tr><td>URL Баннера</td><td><a href='".$row[4]."' target='_blank'>".$row[4]."</a></td></tr>
<tr><td>Размеры</td><td>".$row[6]."x".$row[7]." px</td></tr>
<tr><td>HOLD</td><td>"); if($row[9]==1) echo("Включен"); else echo("Отключен"); echo("</td></tr>");
}

}

echo("</table>");


unset($row,$query_array);	









echo("<br><b>Купленные баннеры</b><br><br>");




echo("<table class='ap_list_table'>
	<tr>
		<td class='ap_list_table_td'>Ссылка</td>
		<td class='ap_list_table_td'>Дата удаления баннера</td>
		<td class='ap_list_table_td'>Модерирование</td>
</tr>");
$query_arr2=mysql_fetch_array(mysql_query("SELECT `id` FROM `tables` WHERE `id`='".intval($get_array['id'])."' AND `uid`='".$user_arr[0]."'"));
$site_arr=mysql_query("SELECT `href`,`lim`,`id`,`price` FROM `abanner` WHERE `sid`='".intval($get_array['id'])."' AND `sid`='".$query_arr2[0]."' AND `status`='2'");
if(mysql_num_rows($site_arr)=="0")
echo("
<tr>
	<td colspan='3'>У вас пока нет купленных баннеров</td>
</tr>");
while($row=mysql_fetch_array($site_arr))
{
	echo("<tr>
		<td><a href='".$row[0]."' target='_blank'>".$row[0]."</a></td><td>".$row[1]."</td><td>Удалить? Пишите в Тикеты</td>
	</tr>");
}

echo("</table> <br><br>");
unset($row,$site_arr);

}
?>