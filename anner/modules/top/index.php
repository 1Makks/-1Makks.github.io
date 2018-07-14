<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");

echo("<title>Топ : ".$params_array[0]."</title>");

if(auth===FALSE)
{
	msg("Для доступа к данной странице необходима авторизация или <a href='/registration.html'>регистрация</a>!","warning");
}
else
{

echo("<b>Топ пользователей по заработку за все время:<br></b><br>
<table class='ap_list_table'>
	<tr>
		<td class='ap_list_table_td'>№</td>
		<td class='ap_list_table_td'>ID</td>
		<td class='ap_list_table_td'>Заработано</td>
</tr>");
$u=1;
$perpage="10";
$site_arr=mysql_query("SELECT `id`,`tops` FROM `users` WHERE `tops`>'0' ORDER BY `tops` DESC LIMIT $perpage");
if(mysql_num_rows($site_arr)=="0")
echo("
<tr>
	<td colspan='3'>Топ отключен</td>
</tr>");
while($row=mysql_fetch_array($site_arr))
{
echo("<tr><td>$u</td>");	 
if($user_arr[0]==$row[0]) 
{ 
echo("<td><font color='red'><b>Вы</b></font></td>"); 
}
else 
{
echo("<td>".$row[0]."</td>"); 
}

		echo("<td>"); 
$yt=$row[1]; echo("".$yt." руб.</td>
	</tr>");
$u=$u+1;
}

echo("</table>");
unset($row,$query_array);

}

?>