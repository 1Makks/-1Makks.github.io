<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");

echo("
<table class='ap_list_table'>
	<tr>
		<td class='ap_list_table_td'>ID</td>
		<td class='ap_list_table_td'>Тип</td>
		<td class='ap_list_table_td'>URL</td>
		<td class='ap_list_table_td'>Статус</td>
		<td class='ap_list_table_td'>Действия</td>
</tr>");
$perpage="25"; $get_array['pg']=intval($get_array['pg']); $rows=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM `tables`")); $num=ceil($rows[0]/$perpage); unset($rows);
if($get_array['pg']>$num OR $get_array['pg']<1 OR $get_array['pg']=="0") $get_array['pg']="1"; $start=intval($get_array['pg']*$perpage-$perpage);
$site_arr=mysql_query("SELECT `id`,`url`,`status`,`t`,`uid` FROM `tables` ORDER BY `id` DESC LIMIT $start,$perpage");
if(mysql_num_rows($site_arr)=="0")
echo("
<tr>
	<td colspan='3'>Нет записей</td>
</tr>");
while($row=mysql_fetch_array($site_arr))
{
	echo("<tr>
		<td>".$row[0]." ("); $query_arr=mysql_fetch_array(mysql_query("SELECT `id`,`login` FROM `users` WHERE `id`='".$row[4]."'")); echo("<a href='/".$config['admin'].".php?page=users&sub=info&id=$query_arr[0]'>$query_arr[1]</a>"); echo(")</td>
		<td><img src='template/apimages/code.png'> "); if($row[3]==1) echo("Ссылка"); else echo("Баннер"); echo("</td>
		<td><a href='$row[1]' target='_blank'>$row[1]</a></td>
		<td>"); 
		if($row[2]==1) echo("<img src='template/apimages/warning.png'> Модерация"); 
		elseif($row[2]==2) echo("<img src='template/apimages/ok.png'> Работает"); 
		else echo("<img src='template/apimages/banned.png'> Заблокирован"); echo("</td>
		<td>
			<a href='".$config['admin'].".php?page=sites&sub=delete&id=".$row[0]."'><img src='template/apimages/delete.png'></a>
			<a href='".$config['admin'].".php?page=sites&sub=ban&id=".$row[0]."'><img src='template/apimages/banned.png'></a>
			<a href='".$config['admin'].".php?page=sites&sub=ok&id=".$row[0]."'><img src='template/apimages/ok.png'></a>
		</td>
	</tr>");
}

$i=1; $pagep=$get_array['pg']+1; $pagem=$get_array['pg']-1; 

if($get_array['pg']>1) 
{ 
echo("<a class='ap_nav_block_a' href='".$config['admin'].".php?page=sites&pg=$pagem'><font size='5'>Назад</font></a> ");
} 
while($i<=$num) 
{
if($get_array['pg']==$i) 
{ 
echo("<b>"); 
} 
echo("<a class='ap_nav_block_a' href='".$config['admin'].".php?page=sites&pg=$i'><font size='5'>$i</font></a> ");
if($get_array['pg']==$i) 
{ 
echo("</b>"); 
} 
$i++; 
} 
if($get_array['pg']<$num) 
{ 
echo("<a class='ap_nav_block_a' href='".$config['admin'].".php?page=sites&pg=$pagep'><font size='5'>Вперед</font></a>");
}

echo("</table>");
unset($row,$site_arr);
?>