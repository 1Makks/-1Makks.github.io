<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");
echo("
<table class='ap_list_table'>
	<tr>
		<td class='ap_list_table_td'>ID</td>
		<td class='ap_list_table_td'>WMR</td>
		<td class='ap_list_table_td'>Дата</td>
		<td class='ap_list_table_td'>Статус</td>
		<td class='ap_list_table_td'>Действия</td>
</tr>");
$perpage="20"; $get_array['pg']=intval($get_array['pg']); $rows=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM `outbalance`")); $num=ceil($rows[0]/$perpage); unset($rows);
if($get_array['pg']>$num OR $get_array['pg']<1 OR $get_array['pg']=="0") $get_array['pg']="1"; $start=intval($get_array['pg']*$perpage-$perpage);
$site_arr=mysql_query("SELECT `id`,`r`,`status`,`date`,`uid`,`summa` FROM `outbalance` ORDER BY `id` DESC LIMIT $start,$perpage");
if(mysql_num_rows($site_arr)=="0")
echo("
<tr>
<td colspan='3'>Нет записей</td>
</tr>");
while($row=mysql_fetch_array($site_arr))
{
	echo("<tr>
		<td>".$row[0]." "); $query_arr=mysql_fetch_array(mysql_query("SELECT `login`,`id` FROM `users` WHERE `id`='$row[4]'")); echo("<a href='/".$config['admin'].".php?page=users&sub=info&id=$query_arr[1]'>$query_arr[0]</a></td>
		<td>".$row[1]." (".$row[5]." руб.)</td>
		<td>".$row[3]."</td>
		<td>"); 
		if($row[2]==1) echo("<img src='template/apimages/warning.png'>"); 
		elseif($row[2]==2) echo("<img src='template/apimages/ok.png'>"); 
		else echo("<img src='template/apimages/banned.png'> Отказано"); echo("</td>
		<td>
			<a href='/".$config['admin'].".php?page=balance&sub=delete&id=".$row[0]."'><img src='template/apimages/delete.png'></a>
			<a href='/".$config['admin'].".php?page=balance&sub=ban&id=".$row[0]."'><img src='template/apimages/banned.png'></a>
			<a href='/".$config['admin'].".php?page=balance&sub=ok&id=".$row[0]."'><img src='template/apimages/ok.png'></a>
			<a href='wmk:payto?Purse=".$row[1]."&Amount=".$row[5]."&Desc=Выплаты с Links-Banners'>[WM]</a>
		</td>
	</tr>");
}
echo("</table>");
$i=1; $pagep=$get_array['pg']+1; $pagem=$get_array['pg']-1; 
if($get_array['pg']>1) 
{ 
echo("<a class='ap_nav_block_a' href='/".$config['admin'].".php?page=balance&pg=$pagem'>Назад</a> ");
} 
while($i<=$num) 
{
if($get_array['pg']==$i) 
{ 
echo("<b>"); 
} 
echo("<a class='ap_nav_block_a' href='/".$config['admin'].".php?page=balance&pg=$i'>$i</a> ");
if($get_array['pg']==$i) 
{ 
echo("</b>"); 
} 
$i++; 
} 
if($get_array['pg']<$num) 
{ 
echo("<a class='ap_nav_block_a' href='/".$config['admin'].".php?page=balance&pg=$pagep'>Вперед</a>");
}
unset($row,$site_arr);
?>