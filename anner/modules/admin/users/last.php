<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");

echo("<br>Нас сегодня посетили:<br><br>");

echo("
<table class='ap_list_table'>
	<tr>
		<td class='ap_list_table_td'>ID</td>
		<td class='ap_list_table_td'>Логин</td>
		<td class='ap_list_table_td'>Время</td>
</tr>");
$site_arr=mysql_query("SELECT `id`,`login`,`lastdate` FROM `users` ORDER BY `lastdate` ASC");
if(mysql_num_rows($site_arr)=="0")
echo("
<tr>
	<td colspan='3'>Нет записей</td>
</tr>");

while($row=mysql_fetch_array($site_arr))
{

if($row[2]>date("d.m.Y"))
	echo("<tr>
		<td>".$row[0]."</td>
		<td><a href='/".$config['admin'].".php?page=users&sub=info&id=$row[0]'>".$row[1]."</a></td>
		<td>".$row[2]."</td>
	</tr>");

}
echo("</table>");



unset($row,$site_arr);

echo("<br><br>Сегодня зарегистрировались:<br><br>");


echo("
<table class='ap_list_table'>
	<tr>
		<td class='ap_list_table_td'>ID</td>
		<td class='ap_list_table_td'>Логин</td>
		<td class='ap_list_table_td'>Время</td>
</tr>");
$site_arr=mysql_query("SELECT `id`,`login`,`regdate` FROM `users` ORDER BY `lastdate` DESC");
if(mysql_num_rows($site_arr)=="0")
echo("
<tr>
	<td colspan='3'>Нет записей</td>
</tr>");

while($row=mysql_fetch_array($site_arr))
{
if($row[2]>date("d.m.Y"))
	echo("<tr>
		<td>".$row[0]."</td>
		<td><a href='/".$config['admin'].".php?page=users&sub=info&id=$row[0]'>".$row[1]."</a></td>
		<td>".$row[2]."</td>
	</tr>");

}
echo("</table>");

unset($row,$site_arr);

?> 