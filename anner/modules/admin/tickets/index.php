<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");


if(count($post_array)>0)
	{
			if($post_array['atext']=="")
			{
				$err="Введите текст";
			}
                                          if(strlen($post_array['atext'])>500)
			{
				$err="(500 символов максимум)";
			}
		if($err=="")
		{
			$query=mysql_query("UPDATE `tickets` SET `atext`='".$post_array['atext']."' WHERE `id`='".$post_array['to']."' ");
			if($query) header("location: /".$config['admin'].".php?page=tickets"); else msg("Ошибка при изменении","warning");
		}
		else
		{
			msg($err,"warning");
		}
	}
	else
	{
		echo("<form action='' method='POST'>
                            ID:  <input type='text' name='to'><br>
                            <textarea cols='50' rows='8' name='atext'></textarea>
		<br><br><input type='submit' value='Ответить'>
		</form>");
	}


echo("
<table class='ap_list_table'>
	<tr>
		<td class='ap_list_table_td'>ID</td>
		<td class='ap_list_table_td'>Кому</td>
		<td class='ap_list_table_td'>Вопрос/Ответ</td>
		<td class='ap_list_table_td'>Дата</td>
		<td class='ap_list_table_td'>D</td>
</tr>");

$perpage="15"; $get_array['pg']=intval($get_array['pg']); $rows=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM `tickets`")); $num=ceil($rows[0]/$perpage); unset($rows);
if($get_array['pg']>$num OR $get_array['pg']<1 OR $get_array['pg']=="0") $get_array['pg']="1"; $start=intval($get_array['pg']*$perpage-$perpage);
$site_arr=mysql_query("SELECT `id`,`uid`,`text`,`atext`,`date` FROM `tickets` ORDER BY `id` DESC LIMIT $start,$perpage");
if(mysql_num_rows($site_arr)=="0")
echo("
<tr>
	<td colspan='3'>Нет записей</td>
</tr>");
while($row=mysql_fetch_array($site_arr))
{
	echo("<tr><td COLSPAN='5'><hr></td><td></tr><tr>
		<td>".$row[0]."</td>
		<td>");
 $query_arr1=mysql_fetch_array(mysql_query("SELECT `login`,`id` FROM `users` WHERE `id`='".$row[1]."'")); echo("<a href='/".$config['admin'].".php?page=users&sub=info&id=$query_arr1[1]'>$query_arr1[0]</a></td>
		<td>".$row[2]."<br><br>".$row[3]."</td>
		<td>".$row[4]."</td>
		<td><a href='/".$config['admin'].".php?page=tickets&sub=delete&id=".$row[0]."'><img src='template/apimages/delete.png'></a></td>
	</tr>");
}
echo("</table><br><br>");
$i=1; $pagep=$get_array['pg']+1; $pagem=$get_array['pg']-1; 
if($get_array['pg']>1) 
{ 
echo("<a class='ap_nav_block_a' href='/".$config['admin'].".php?page=tickets&pg=$pagem'>Назад</a> ");
} 
while($i<=$num) 
{
if($get_array['pg']==$i) 
{ 
echo("<b>"); 
} 
echo("<a class='ap_nav_block_a' href='/".$config['admin'].".php?page=tickets&pg=$i'>$i</a> ");
if($get_array['pg']==$i) 
{ 
echo("</b>"); 
} 
$i++; 
} 
if($get_array['pg']<$num) 
{ 
echo("<a class='ap_nav_block_a' href='".$config['admin'].".php?page=tickets&pg=$pagep'>Вперед</a>");
}
unset($row,$site_arr);
?>