<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");

echo("<title>Статистика : ".$params_array[0]."</title>");

$perpage="20"; $get_array['pg']=intval($get_array['pg']); $rows=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM `money`")); $num=ceil($rows[0]/$perpage); unset($rows);
if($get_array['pg']>$num OR $get_array['pg']<1 OR $get_array['pg']=="0") $get_array['pg']="1"; $start=intval($get_array['pg']*$perpage-$perpage);
echo("
		<b>Пополнение баланса пользователей:</b><br><br>
	<table class='ap_list_table'>
		<tr>
			<td class='ap_list_table_td'>№</td>
			<td class='ap_list_table_td'>Пользователь</td>
			<td class='ap_list_table_td'>Дата</td>
			<td class='ap_list_table_td'>Сумма</td>
	</tr>");
	$site_arr=mysql_query("SELECT `uid`,`date`,`summa` FROM `money` ORDER BY `id` DESC LIMIT $start,$perpage");
	if(mysql_num_rows($site_arr)=="0")
	echo("
	<tr>
		<td colspan='3'>Статистика отсутствует</td>
	</tr>"); $i=1;
	while($row=mysql_fetch_array($site_arr))
	{
		echo("<tr>
			<td>".$i."</td><td>");
$query_arr1=mysql_fetch_array(mysql_query("SELECT `login`,`id` FROM `users` WHERE `id`='".$row[0]."'")); echo("<a href='/".$config['admin'].".php?page=users&sub=info&id=$query_arr1[1]'>$query_arr1[0]</a></td>");
                        echo("</td>
			<td>".$row[1]."</td>
			<td>".$row[2]." руб.</td></tr>");  $i=$i+1;
}
$i=1; $pagep=$get_array['pg']+1; $pagem=$get_array['pg']-1; 
if($get_array['pg']>1) 
{ 
echo("<a class='ap_nav_block_a' href='/".$config['admin'].".php?page=money&pg=$pagem'>Назад</a> ");
} 
while($i<=$num) 
{
if($get_array['pg']==$i) 
{ 
echo("<b>"); 
} 
echo("<a class='ap_nav_block_a' href='/".$config['admin'].".php?page=money&pg=$i'>$i</a> ");
if($get_array['pg']==$i) 
{ 
echo("</b>"); 
} 
$i++; 
} 
if($get_array['pg']<$num) 
{ 
echo("<a class='ap_nav_block_a' href='/".$config['admin'].".php?page=money&pg=$pagep'>Вперед</a>");
}
	echo("</table>");
	unset($row,$site_arr);
?>