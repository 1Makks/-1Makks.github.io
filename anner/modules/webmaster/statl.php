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
$site_arr=mysql_query("SELECT `url`,`t`,`price`,`linknum`,`defban`,`maxtext`,`w`,`d`,`forma`,`name` FROM `tables` WHERE `id`='".intval($get_array['id'])."' AND `uid`='".$user_arr[0]."'");
if(mysql_num_rows($site_arr)=="0")
echo("
<tr>
	<td colspan='3'>Ошибка</td>
</tr>");
while($row=mysql_fetch_array($site_arr))
{

if($row[1]==1)
{
echo("
<tr><td>Название</td><td>".$row[9]."</td></tr>
<tr><td>URL</td><td><a href='".$row[0]."' target='_blank'>".$row[0]."</a></td></tr>
<tr><td>Цена</td><td>".$row[2]." руб.</td></tr>
<tr><td>Вид витрины</td><td>"); if($row[8]==1 OR $row[8]==0) echo("Вертикальная"); if($row[8]==2) echo("Горизонтальная"); echo("</td></tr>
<tr><td>Ссылок в блоке</td><td>".$row[3]."</td></tr>
<tr><td>Длина текста ссылок</td><td>".$row[5]."</td></tr>");
}

}

echo("</table>");


unset($row,$query_array);	









echo("<br><b>Купленные ссылки</b><br><br>");



echo("<table class='ap_list_table'>
	<tr>
		<td class='ap_list_table_td'>Ссылка</td>
		<td class='ap_list_table_td'>Дата покупки</td>
		<td class='ap_list_table_td'>Модерирование</td>
</tr>");
$query_arr2=mysql_fetch_array(mysql_query("SELECT `id` FROM `tables` WHERE `id`='".intval($get_array['id'])."' AND `uid`='".$user_arr[0]."'"));
$site_arr=mysql_query("SELECT `href`,`text`,`date`,`sid`,`id`,`price` FROM `alink` WHERE `sid`='".intval($get_array['id'])."' AND `sid`='".$query_arr2[0]."' AND `status`='2' ORDER BY `date` DESC");
if(mysql_num_rows($site_arr)=="0")
echo("
<tr>
	<td colspan='3'>У вас пока нет купленных ссылок</td>
</tr>");
while($row=mysql_fetch_array($site_arr))
{
	echo("<tr>
		<td><a href='".$row[0]."' target='_blank'>".$row[1]."</a></td><td>"); if($row[2]==0) echo("До 18 мая 2011"); else echo(" ".$row[2]." "); echo("</td><td>"); if($row[5]!=0) echo("<a href='/webmaster.html&sub=editl&id=".$row[4]."'><center><img src='template/apimages/edit.png'></center></a>"); else echo("Отредактировать нельзя"); echo("</td>
	</tr>");
}

echo("</table> <br>* В случае если ссылка содержит ненормативную лексику, вы вправе отредактировать ее текст.<br><br>");
unset($row,$site_arr);




}
?>