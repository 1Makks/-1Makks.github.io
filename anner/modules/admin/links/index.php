<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");


$query_array=mysql_query("SELECT `id`,`href`,`pos` FROM `links` ORDER BY `pos` DESC"); 


echo("<a href='/".$config['admin'].".php?page=links&sub=add'><img src='/images/icon/link.png' width='15' height='15' align='absmiddle'>Добавить сайт</a><br><br>

<table class='ap_list_table'><tr>
<td class='ap_list_table_td'>ID</td>
<td class='ap_list_table_td'>uID</td>
<td class='ap_list_table_td'>Адрес</td>
<td class='ap_list_table_td'>Цена</td>
<td class='ap_list_table_td'>Опции</td>
</tr>"); 
if(mysql_num_rows($query_array)=="0") 
{ 
echo("<tr><td colspan='5'>Ничего не найдено</td></tr>"); 
} 
while($row=mysql_fetch_array($query_array)) 
{ 
echo("<tr><td>$row[0]</td>");

$query_arr1=mysql_fetch_array(mysql_query("SELECT `price`,`url` FROM `tables` WHERE `id`='".$row[1]."'"));
$pars1=mysql_fetch_array(mysql_query("SELECT `pr`,`cu`,`yahoo`,`lipok`,`lipos` FROM `pars` WHERE `uid`='$row[1]'"));

echo("<td>$row[2]</td><td><a href='$query_arr1[1]' target='_blank'>$query_arr1[1]</a></td>

<td>$query_arr1[0]</td><td> <a href='/".$config['admin'].".php?page=links&sub=pos&id=$row[0]'><img src='template/apimages/edit.png' align='absmiddle'></a><a href='/".$config['admin'].".php?page=links&sub=on'><img src='/template/apimages/refresh.png' width='15' height='15' align='absmiddle'></a> <a href='/".$config['admin'].".php?page=links&sub=delete&id=$row[0]'><img src='template/apimages/delete.png' align='absmiddle'></a> </td></tr>"); 
} 
echo("</table>
              <br><br><img src='template/apimages/edit.png' align='absmiddle'> — Добавить сайт<br><br>
			  <img src='/template/apimages/refresh.png' align='absmiddle'> — Обновить статистику<br><br>
			  <img src='template/apimages/delete.png' align='absmiddle'></a> — Удалить                      
               ");
echo("</table>"); 
?> 

