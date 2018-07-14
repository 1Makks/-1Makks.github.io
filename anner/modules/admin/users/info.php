<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");

$query=mysql_fetch_array(mysql_query("SELECT `id`,`login`,`email`,`group`,`icq`,`wmr`,`ip`,`lastip`,`balance`,`regdate`,`lastdate`,`num`,`tops`,`hold` FROM `users` WHERE `id`='".intval($get_array['id'])."'"));

if($query[0]=="") 
{ 
msg("Пользователь с таким ID не найден!","warning"); 
} 
else 
{ 
echo(" <table class='ap_list_table'>
<tr><td class='ap_list_table_td'>Поле</td><td class='ap_list_table_td'>Содержание</td></tr>
<tr><td>ID</td><td>$query[0]</td></tr>
<tr><td>Логин</td><td>$query[1]</td></tr>
<tr><td>Email</td><td>$query[2]</td></tr>
<tr><td>Группа</td><td>
"); 

if($query[3]=="1") 
echo("Пользователь"); 
elseif($query[3]=="2") 
echo("Администратор"); 
else 
echo("_error"); 
echo("</td></tr>

<tr><td>ICQ</td><td>$query[4]</td></tr>
<tr><td>WMR</td><td>$query[5]</td></tr>
<tr><td>IP реги</td><td>$query[6]</td></tr>
<tr><td>IP входа</td><td>$query[7]</td></tr>
<tr><td>Баланс</td><td>$query[8] руб </td></tr>
<tr><td>Выплачено</td><td>$query[12] руб</td></tr>
<tr><td>HOLD</td><td>$query[13] руб</td></tr>
<tr><td>Дата реги</td><td>$query[9]</td></tr>
<tr><td>Дата входа</td><td>$query[10]</td></tr>
<tr><td>Создано витрин</td><td>$query[11]</td></tr>
<tr><td>Рефералы</td><td>");


	$ref_arr=mysql_query("SELECT `id`,`login`,`rbalance` FROM `users` WHERE `rid`='".intval($get_array['id'])."' ORDER BY `rbalance` DESC");
	if(mysql_num_rows($ref_arr)=="0")
	echo("Нет рефералов");
	while($row=mysql_fetch_array($ref_arr))
	{
		echo("<a href='/".$config['admin'].".php?page=users&sub=info&id=".$row[0]."' target='_blank'>".$row[1]."</a>(".$row[2].str_replace("1","$",str_replace("2","руб.",$config['valuta']))."), ");
	}


 echo("</td></tr></table> "); 

} 


echo("<br /><center><a href='/".$config['admin'].".php?page=stats&id=".intval($get_array['id'])."'><b>Полная статистика</b></a></center>");


echo("<br>
<table class='ap_list_table'>
	<tr>
		<td class='ap_list_table_td'>Поле</td>
		<td class='ap_list_table_td'>Содержимое</td>
</tr>");
$site_arr=mysql_query("SELECT `id`,`url`,`t`,`price`,`linknum`,`defban`,`maxtext`,`w`,`d`,`schet`,`forma`,`name` FROM `tables` WHERE `uid`='".intval($get_array['id'])."'");
if(mysql_num_rows($site_arr)=="0")
echo("
<tr>
	<td colspan='3'>Нет площадок</td>
</tr>");
while($row=mysql_fetch_array($site_arr))
{

if($row[2]==1)
{
echo("<tr><td colspan='2'><hr></td></tr>
<tr><td>Статистика</td><td><a href='".$config['admin'].".php?page=users&sub=on&id=".$row[0]."'>Обновить</a></td></tr>
<tr><td>Название</td><td>".$row[11]."</td></tr>
<tr><td>ID</td><td>".$row[0]."</td></tr>
<tr><td>URL</td><td><a href='".$row[1]."' target='_blank'>".$row[1]."</a></td></tr>
<tr><td>Цена</td><td>".$row[3]." руб.</td></tr>
<tr><td>Вид витрины</td><td>"); if($row[10]==1 OR $row[10]==0) echo("Вертикальная"); if($row[10]==2) echo("Горизонтальная"); echo("</td></tr>
<tr><td>Ссылок в блоке</td><td>".$row[4]."</td></tr>
<tr><td>Длина текста ссылок</td><td>".$row[6]."</td></tr>
<tr><td>Переходы</td><td>".$row[9]."</td></tr>
<tr><td>Ссылки в витрине</td><td><script language='JavaScript' charset='windows-1251' src='/codes/link.php?id=".$row[0]."'></script></td></tr>");
}
if($row[2]==2)
{
echo("<tr><td colspan='2'><hr></td></tr>
<tr><td>Статистика</td><td><a href='".$config['admin'].".php?page=users&sub=on&id=".$row[0]."'>Обновить</a></td></tr>
<tr><td>Название</td><td>".$row[11]."</td></tr>
<tr><td>ID</td><td>".$row[0]."</td></tr>
<tr><td>URL</td><td><a href='".$row[1]."' target='_blank'>".$row[1]."</a></td></tr>
<tr><td>Цена</td><td>".$row[3]." руб.</td></tr>
<tr><td>URL Баннера</td><td>".$row[5]."</td></tr>
<tr><td>Размеры</td><td>".$row[7]."x".$row[8]." px</td></tr>
<tr><td>Переходы</td><td>".$row[9]."</td></tr>
<tr><td>Баннер в витрине</td></tr>");
$jh=$row[0];


$site_arr2=mysql_query("SELECT `href`,`ban_href`,`lim`,`id`,`price` FROM `abanner` WHERE `sid`='".$jh."' AND `status`='2' ORDER BY `id` ASC");
if(mysql_num_rows($site_arr2)=="0")
echo("<tr><td colspan='2'>нет купленных баннеров</td></tr>");
while($row=mysql_fetch_array($site_arr2))
{
	echo("<tr><td colspan='2'><a href='".$row[0]."' target='_blank'><img alt='".$row[2]."' title='".$row[2]."' src='".$row[1]."'></a></td></tr>");
}

unset($row,$site_arr2);

}

}

echo("</table>");

?> 