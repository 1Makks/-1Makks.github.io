<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");

$perpage="25"; 
$get_array['pg']=intval($get_array['pg']); 
$rows=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM `news`")); 
$num=ceil($rows[0]/$perpage); unset($rows);
if($get_array['pg']>$num OR $get_array['pg']<1 OR $get_array['pg']=="0") 
$get_array['pg']="1"; 
$start=intval($get_array['pg']*$perpage-$perpage);
$query_array=mysql_query("SELECT `id`,`date`,`descr`,`content` FROM `news` ORDER BY `id` DESC LIMIT $start,$perpage"); 

echo("<div class='ap_add'><a href='/".$config['admin'].".php?page=news&sub=add'><img src='/img/add2.png' width='14' height='14' align='absmiddle'>Добавить новость</a></div><br/>

<table class='ap_list_table'><tr>
<td class='ap_list_table_td'>ID</td>
<td class='ap_list_table_td'>Дата</td>
<td class='ap_list_table_td'>Заголовок</td>
<td class='ap_list_table_td'>Текст</td>
<td class='ap_list_table_td'>Управление</td>
</tr>"); 
if(mysql_num_rows($query_array)=="0") 
{ 
echo("<tr><td colspan='5'>Ничего не найдено</td></tr>"); 
} 
while($row=mysql_fetch_array($query_array)) 
{ 
echo("<tr><td>$row[0]</td><td>"); 
//
echo("$row[1]</td><td>$row[2]</td><td>$row[3]</td>
<td>
<a href='/".$config['admin'].".php?page=news&sub=delete&id=$row[0]'><img src='template/apimages/delete.png'></a>
<a href='/".$config['admin'].".php?page=news&sub=edit&id=$row[0]'><img src='template/apimages/edit.png'></a>
</td></tr> "); 
} 
echo("</table>"); 
$i=1; 
$pagep=$get_array['pg']+1; 
$pagem=$get_array['pg']-1; 
echo("<div class='ap_nav_block'>");
if($get_array['pg']>1) 
{
 echo("<a class='ap_nav_block_a' href='/".$config['admin'].".php?page=news&pg=$pagem'>Назад</a>");
} 
while($i<=$num) 
{ 
if($get_array['pg']==$i) 
{ 
echo("<b>"); 
} 
echo("<a class='ap_nav_block_a' href='/".$config['admin'].".php?page=news&pg=$i'>$i</a> ");
if($get_array['pg']==$i) 
{ 
echo("</b>"); 
} 
$i++; 
} 
if($get_array['pg']<$num) 
{ 
echo("<a class='ap_nav_block_a' href='/".$config['admin'].".php?page=news&pg=$pagep'>Вперед</a>");
} 
echo("</table>
              <br><br><img src='/template/apimages/delete.png'> — Удаление новости
              <br><br><img src='/template/apimages/edit.png'> — Редактирование новости
               <br><br>");
echo("</div>"); 
?> 