<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");

echo("
<table class='ap_list_table'>
	<tr>
		<td class='ap_list_table_td'>ID</td>
		<td class='ap_list_table_td'>URL</td>
		<td class='ap_list_table_td'>Статус</td>
		<td class='ap_list_table_td'>Действия</td>
</tr>");
$perpage="20"; $get_array['pg']=intval($get_array['pg']); $rows=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM `abanner`")); $num=ceil($rows[0]/$perpage); unset($rows);
if($get_array['pg']>$num OR $get_array['pg']<1 OR $get_array['pg']=="0") $get_array['pg']="1"; $start=intval($get_array['pg']*$perpage-$perpage);
$site_arr=mysql_query("SELECT `id`,`href`,`status`,`ban_href`,`sz`,`uid`,`sid`,`lim`,`price` FROM `abanner` ORDER BY `id` DESC LIMIT $start,$perpage");
if(mysql_num_rows($site_arr)=="0")
echo("
<tr>
	<td colspan='3'>Нет записей</td>
</tr>");
while($row=mysql_fetch_array($site_arr))
{
	echo("<tr>
		<td>".$row[0]." "); $query_arr2=mysql_fetch_array(mysql_query("SELECT `uid` FROM `tables` WHERE `id`='".$row[6]."'")); $query_arr=mysql_fetch_array(mysql_query("SELECT `id`,`login` FROM `users` WHERE `id`='".$query_arr2[0]."'")); echo("</td>
		<td><a href='/".$config['admin'].".php?page=users&sub=info&id=$query_arr[0]'>$query_arr[1]</a><p></p><a href=".$row[1]." target=_blank>".$row[1]."</a><p></p>"); $query_arr1=mysql_fetch_array(mysql_query("SELECT `url` FROM `tables` WHERE `id`='".$row[6]."'")); echo(" <a href=".$query_arr1[0]." target=_blank>".$query_arr1[0]."</a><p></p>".$row[8]."  рублей<p></p>".$row[7]."</td>
		<td>"); 
		if($row[2]==1) echo("<img src='template/apimages/warning.png'>"); 
		elseif($row[2]==2) echo("<img src='template/apimages/ok.png'>"); 
		else echo("<img src='template/apimages/banned.png'>"); echo("</td>
		<td>
			<a href='/".$config['admin'].".php?page=advban&sub=delete&id=".$row[0]."'><img src='template/apimages/delete.png'></a>
			<a href='/".$config['admin'].".php?page=advban&sub=ban&id=".$row[0]."'><img src='template/apimages/banned.png'></a>
			<a href='/".$config['admin'].".php?page=advban&sub=ok&id=".$row[0]."'><img src='template/apimages/ok.png'></a>
		</td></tr><tr><td colspan='4'><hr></td>
	</tr>");
}
echo("</table>");

$i=1; $pagep=$get_array['pg']+1; $pagem=$get_array['pg']-1; 

if($get_array['pg']>1) 
{ 
echo("<a class='ap_nav_block_a' href='/".$config['admin'].".php?page=advban&pg=$pagem'>Назад</a> ");
} 
while($i<=$num) 
{
if($get_array['pg']==$i) 
{ 
echo("<b>"); 
} 
echo("<a class='ap_nav_block_a' href='/".$config['admin'].".php?page=advban&pg=$i'>$i</a> ");
if($get_array['pg']==$i) 
{ 
echo("</b>"); 
} 
$i++; 
} 
if($get_array['pg']<$num) 
{ 
echo("<a class='ap_nav_block_a' href='/".$config['admin'].".php?page=advban&pg=$pagep'>Вперед</a>");
}

unset($row,$site_arr);
?>