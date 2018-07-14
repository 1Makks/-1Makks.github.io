<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");

echo("
<table class='ap_list_table'>
	<tr>
		<td class='ap_list_table_td'>ID</td>
		<td class='ap_list_table_td'>Логин</td>
		<td class='ap_list_table_td'>Баланс</td>
</tr>");
$perpage="25"; $get_array['pg']=intval($get_array['pg']); $rows=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM `users`")); $num=ceil($rows[0]/$perpage); unset($rows);
if($get_array['pg']>$num OR $get_array['pg']<1 OR $get_array['pg']=="0") $get_array['pg']="1"; $start=intval($get_array['pg']*$perpage-$perpage);
$site_arr=mysql_query("SELECT `id`,`login`,`balance` FROM `users` ORDER BY `balance` DESC LIMIT $start,$perpage");
if(mysql_num_rows($site_arr)=="0")
echo("
<tr>
	<td colspan='3'>Нет записей</td>
</tr>");
while($row=mysql_fetch_array($site_arr))
{
	echo("<tr>
		<td>".$row[0]."</td>
		<td><a href='/".$config['admin'].".php?page=users&sub=info&id=".$row[0]."'>".$row[1]."</a></td>
		<td>".$row[2]." руб.</td>
	</tr>");

}

$i=1; $pagep=$get_array['pg']+1; $pagem=$get_array['pg']-1; 

if($get_array['pg']>1) 
{ 
echo("<a class='ap_nav_block_a' href='/".$config['admin'].".php?page=users&pg=$pagem'>Назад</a> ");
} 
while($i<=$num) 
{
if($get_array['pg']==$i) 
{ 
echo("<b>"); 
} 
echo("<a class='ap_nav_block_a' href='/".$config['admin'].".php?page=users&pg=$i'>$i</a> ");
if($get_array['pg']==$i) 
{ 
echo("</b>"); 
} 
$i++; 
} 
if($get_array['pg']<$num) 
{ 
echo("<a class='ap_nav_block_a' href='/".$config['admin'].".php?page=users&pg=$pagep'>Вперед</a>");
}

echo("</table>");
unset($row,$query_array);

?>