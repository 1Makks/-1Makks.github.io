<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");

echo("<title>Витрины : ".$params_array[0]."</title>");

if(auth===FALSE)
{
	msg("Для доступа к данной странице необходима авторизация или <a href='/registration.html'>регистрация</a>!","warning");
}
else
{

	echo("
	
              <a href='webmaster.html&sub=add&t=link'><img src='/images/icon/link.png'width='15' height='15' align='absmiddle'>Добавить витрину ссылок</a> | <a href='webmaster.html&sub=add&t=banners'><img src='/images/icon/banner.png' width='15' height='15' align='absmiddle'>Добавить витрину баннеров</a><br><br>
			  <b>Витрины:</b>
	<p></p><table class='ap_list_table'>
		<tr>
			<td class='ap_list_table_td'>№</td>
			<td class='ap_list_table_td'>ID</td>
			<td class='ap_list_table_td'>Тип</td>
			<td class='ap_list_table_td'>Название</td>
			<td class='ap_list_table_td'>Сайт</td>
			<td class='ap_list_table_td'>Управление</td>
	</tr>");
	$site_arr=mysql_query("SELECT `id`,`url`,`status`,`t`,`name` FROM `tables` WHERE `uid`='".mysql_real_escape_string($user_arr[0])."'");
	if(mysql_num_rows($site_arr)=="0")
	echo("
	<tr>
		<td colspan='3'>Нет витрин</td>
	</tr>"); $i=1;
	while($row=mysql_fetch_array($site_arr))
	{ 
		echo("<tr>
			<td>".$i."</td>
			<td>".$row[0]."</td>
			<td> "); if($row[3]==1) echo("Ссылка"); else echo("Баннер"); echo("</td>
			<td>".$row[4]."</td>
			<td>".$row[1]."</td>
			<td>
				<a href='webmaster.html&sub=delete&id=".$row[0]."' alt='Удалить' title='Удалить' border='0'><img src='template/apimages/delete.png'></a>
				<a href='webmaster.html&sub=edit&id=".$row[0]."' alt='Редактировать' title='Редактировать' border='0'><img src='template/apimages/edit.png'></a>
				<a href='webmaster.html&sub=update&id=".$row[0]."' alt='Обновить статистику' title='Обновить статистику' border='0'><img src='template/apimages/update.png'></a>
				"); if($row[3]==1) $stat="statl"; else $stat="statb"; echo("<a href='webmaster.html&sub=".$stat."&id=".$row[0]."' alt='Статистика' title='Статистика' border='0'><img src='template/apimages/info.png'></a>
				<a href='webmaster.html&sub=code&id=".$row[0]."' alt='Код' title='Код' border='0'><img src='template/apimages/code.png'></a>
			</td>
		</tr>"); $i=$i+1;
	}
	echo("</table>
              <br><br><img src='/template/apimages/delete.png'> — Удаление витрины
              <br><br><img src='/template/apimages/edit.png'> — Редактирование витрины
              <br><br><img src='/template/apimages/update.png'> — Обновить статистику
              <br><br><img src='/template/apimages/info.png'> — Статистика и модерирование витрины
              <br><br><img src='/template/apimages/code.png'> — Код витрины
               <br><br>");
	unset($row,$site_arr);
}
?>