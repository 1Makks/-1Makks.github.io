<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");

echo("<title>Топ : ".$params_array[0]."</title>");

if(auth===FALSE)
{
	msg("Для доступа к данной странице необходима авторизация или <a href='/registration.html'>регистрация</a>!","warning");
}
else
{


$yt=0;
$site_arr=mysql_query("SELECT `tops` FROM `users`");
if(mysql_num_rows($site_arr)=="0")
echo("");
while($row=mysql_fetch_array($site_arr))
{
$yt=$yt+$row[0];
}
unset($row,$query_array);

$site_arr=mysql_query("SELECT `balance` FROM `users` WHERE `id`!='1'");
if(mysql_num_rows($site_arr)=="0")
echo("");
while($row=mysql_fetch_array($site_arr))
{
$gg=$gg+$row[0];
}
unset($row,$query_array);


$site_arr=mysql_query("SELECT `hold` FROM `users` WHERE `id`!='1'");
if(mysql_num_rows($site_arr)=="0")
echo("");
while($row=mysql_fetch_array($site_arr))
{
$kk=$kk+$row[0];
}
unset($row,$query_array);


$ou=round(($yt*0.1),2);
$yt=$yt+$gg;
$gg=$gg-($gg*0.04);


$t=0;
$site_arr=mysql_query("SELECT `id` FROM `alink`");
if(mysql_num_rows($site_arr)=="0")
echo("
<tr>
	<td colspan='3'>Нет записей</td>
</tr>");
while($row=mysql_fetch_array($site_arr))
{
	echo("");
$t=$t+1;
}





$r=0;
$site_arr1=mysql_query("SELECT `id` FROM `abanner`");
if(mysql_num_rows($site_arr1)=="0")
echo("
<tr>
	<td colspan='3'>Нет записей</td>
</tr>");
while($row=mysql_fetch_array($site_arr1))
{
	echo("");
$r=$r+1;
}






$w=0;
$site_arr2=mysql_query("SELECT `id` FROM `users`");
if(mysql_num_rows($site_arr2)=="0")
echo("
<tr>
	<td colspan='3'>Нет записей</td>
</tr>");
while($row=mysql_fetch_array($site_arr2))
{
	echo("");
$w=$w+1;
}







$s=0;
$site_arr2=mysql_query("SELECT `id` FROM `tables`");
if(mysql_num_rows($site_arr2)=="0")
echo("
<tr>
	<td colspan='3'>Нет записей</td>
</tr>");
while($row=mysql_fetch_array($site_arr2))
{
	echo("");
$s=$s+1;
}



$v=0;
$site_arr3=mysql_query("SELECT `id`,`uid`,`tip`,`date`,`summa` FROM `statistic` WHERE `tip`='1'");
if(mysql_num_rows($site_arr3)=="0")
echo("Нет записей");
while($row=mysql_fetch_array($site_arr3))
{

$d1=substr("$row[3]", 0, 2);
$m1=substr("$row[3]", 3, 2);
$y1=substr("$row[3]", 6, 4);

if($d1==23 AND $m1==02 AND $y1==2012)
{
$v=$v+$row[4];
}

}
unset($row,$site_arr3);

$v3=0;
$site_arr3=mysql_query("SELECT `id`,`uid`,`tip`,`date`,`summa` FROM `statistic` WHERE `tip`='3'");
if(mysql_num_rows($site_arr3)=="0")
echo("Нет записей");
while($row=mysql_fetch_array($site_arr3))
{

$d1=substr("$row[3]", 0, 2);
$m1=substr("$row[3]", 3, 2);
$y1=substr("$row[3]", 6, 4);

if($d1==23 AND $m1==02 AND $y1==2012)
{
$v3=$v3+$row[4];
}

}
unset($row,$site_arr3);

$v2=($v-$v3)*0.09;

$gg=$gg-($gg*0.05);

$config['yt']=$yt;

echo("<br> Оборот системы: <b>".$yt."</b><br> На счету пользователей: <b>".$gg."</b><br>HOLD: <b>".$kk."</b><br>Заработано: <b>".$ou."</b><br><br>Ссылок: <b>".$t."</b><br>Баннеров: <b>".$r."</b><br>Площадок: <b>".$s."</b><br>Пользователей: <b>".$w."</b><br><br>Оборот сегодня: <b>".$v."</b><br>Заработано сегодня: <b>".$v2."</b>  ");
}

?>