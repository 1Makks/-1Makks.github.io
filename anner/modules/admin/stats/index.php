<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");

echo("<title>Статистика : ".$params_array[0]."</title>");


$shold=mysql_query("SELECT `id` FROM `tables` WHERE `uid`='".intval($get_array['id'])."'");
while($ror=mysql_fetch_array($shold))
{

$sity=mysql_query("SELECT `lim` FROM `abanner` WHERE `hold`='1' AND `sid`='".$ror[0]."' ORDER BY `id` ASC");

	while($row=mysql_fetch_array($sity))
	{
echo("$row[0]<br>");
	}
	unset($row,$sity);

}
unset($ror,$shold);

echo("
		<b>Статистика:</b><br><br>
	<table class='ap_list_table'>
		<tr>
			<td class='ap_list_table_td'>№</td>
			<td class='ap_list_table_td'>Тип</td>
			<td class='ap_list_table_td'>Сумма</td>
			<td class='ap_list_table_td'>Дата</td>
			<td class='ap_list_table_td'>Баланс</td>
	</tr>");
$perpage="20"; $get_array['pg']=intval($get_array['pg']); $rows=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM `statistic` WHERE `uid`='".intval($get_array['id'])."'")); $num=ceil($rows[0]/$perpage); unset($rows);
if($get_array['pg']>$num OR $get_array['pg']<1 OR $get_array['pg']=="0") $get_array['pg']="1"; $start=intval($get_array['pg']*$perpage-$perpage);
	$site_arr=mysql_query("SELECT `id`,`tip`,`date`,`summa`,`balance` FROM `statistic` WHERE `uid`='".intval($get_array['id'])."' ORDER BY `id` DESC LIMIT $start,$perpage");
	if(mysql_num_rows($site_arr)=="0")
	echo("
	<tr>
		<td colspan='3'>Статистика отсутствует</td>
	</tr>"); $i=1;
	while($row=mysql_fetch_array($site_arr))
	{

// $dd=substr("$row[2]", 0, 2);
// $mm=substr("$row[2]", 3, 2);
// if($dd==9 AND $mm==11)

		echo("<tr>
			<td>".$i."</td><td>");
                             if($row[1]==1) echo("<img src='template/apimages/ok.png'> Покупка"); 
                             elseif($row[1]==2) echo("<img src='template/apimages/pay.png'> Выплата");
                             elseif($row[1]==3) echo("<img src='template/apimages/remove.png'> Оплата");
                             elseif($row[1]==4) echo("<img src='template/apimages/add.png'> Пополнение");
                             elseif($row[1]==5) echo("<img src='template/apimages/icon_info.png'> Зачисление холда");
                             elseif($row[1]==6) echo("<img src='template/apimages/icon_info.png'> Списание холда");
                             elseif($row[1]==7) echo("<img src='template/apimages/delete.png'> Возврат");
                        echo("</td>
			<td>".$row[3]." руб.</td>
			<td>".$row[2]."</td>
			<td>".$row[4]." руб. $f</td>
			<td>");  $i=$i+1;
	}

	echo("</table>");

$i=1; $pagep=$get_array['pg']+1; $pagem=$get_array['pg']-1; 

if($get_array['pg']>1) 
{ 
echo("<a class='ap_nav_block_a' href='/".$config['admin'].".php?page=stats&id=".intval($get_array['id'])."&pg=$pagem'>Назад</a> ");
} 
while($i<=$num) 
{
if($get_array['pg']==$i) 
{ 
echo("<b>"); 
} 
echo("<a class='ap_nav_block_a' href='/".$config['admin'].".php?page=stats&id=".intval($get_array['id'])."&pg=$i'>$i</a> ");
if($get_array['pg']==$i) 
{ 
echo("</b>"); 
} 
$i++; 
} 
if($get_array['pg']<$num) 
{ 
echo("<a class='ap_nav_block_a' href='/".$config['admin'].".php?page=stats&id=".intval($get_array['id'])."&pg=$pagep'>Вперед</a>");
}

	unset($row,$site_arr);
?>