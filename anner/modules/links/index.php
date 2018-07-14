<?php

if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");

// Вывод title
echo("<title>Рекламодателям: ".$params_array[0]."</title>");

$pars1=mysql_fetch_array(mysql_query("SELECT `pr`,`cu`,`yahoo`,`lipok`,`lipos` FROM `pars` WHERE `uid`='$row[1]'"));


echo("<h2>Рекламодателям</h2>
</br>
<td width='150'><b><img src='/template/apimages/ok.png' width='15' height='15' align='absmiddle'>Витрина ссылок | <a href='/banners.html'>Витрина баннеров</a></b></td>



<div id='adr'><br />Из списка ниже, можете выбрать сайт где вы сможете разместить вашу ссылку.</div>");


$query_array=mysql_query("SELECT `id`,`href`,`pos` FROM `links` ORDER BY `pos` DESC"); 
 
if(mysql_num_rows($query_array)=="0") 
{ 
echo("Рекламодатель! Нужных сайтов для рекламы пока нету!"); 
} 
while($row=mysql_fetch_array($query_array)) 
{ 
echo("<div id='adr'>
<table><tr>"); $query_arr1=mysql_fetch_array(mysql_query("SELECT `price`,`url` FROM `tables` WHERE `id`='".$row[1]."'"));
echo("
<td width='20%'><a>");

$url1=str_replace("http://","",$query_arr1[1]);
$url2=str_replace("www.", "", $url1); 
$url= str_replace("/","",$url2);
$pars1=mysql_fetch_array(mysql_query("SELECT `pr`,`cu`,`yahoo`,`lipok`,`lipos` FROM `pars` WHERE `uid`='$row[1]'"));

echo("<img class='styleLinks' width='150' height='113' src='http://mini.s-shot.ru/1280x1024/400/jpeg/?".$query_arr1[1]."' style='border: 1px solid #1FFF00; border-radius: 4px 4px 4px 4px; padding:2px; margin:5px 20px 0 0;' alt='Скриншот сайта ".$query_arr1[1]."' /> </td>
<td width='30%'>Адрес: <a href='$query_arr1[1]' target='_blank'>$url</a></br>ТИЦ: $pars1[1]</br>PR: $pars1[0]/10</td>

<td width='10%'><img title='Статистика: показано количество просмотров и посетителей' border='0' src='http://counter.yadro.ru/logo;".$query_arr1[1]."?29.20'></td>
</tr>
</table>

</div>"); 
} 


echo("<br />
<br />
Вебмастер, вы появитесь в этом списке, если: <br />

 1. Напишите нам в тикеты.<br />
 2. Ваш сайт должен иметь ежедневную посещаемость выше 100 хостов в день по счетчику LiveInternet.<br />




<br><br>");

?>

