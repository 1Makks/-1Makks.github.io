<?php
if(!defined("AP")) exit($lang['n_d_k_f_n']);

echo("<title>Реферал : ".$params_array[0]."</title>");

if(auth===FALSE)
{
	msg("Для доступа к данной странице необходима авторизация или <a href='/registration.html'>регистрация</a>! ","warning");
}
else
{
	echo("<b>Рефералы:</b><p></p>
                            Вы получаете до 5% от заработка реферала.<br><br>

<b>Рефссылки:</b><br>
		Главная страница сайта<br>
		<input type='text' style='width: 280px;' value='".$config['s_url']."index.php?ref=".$user_arr[0]."'><br><br>
		Страница регистрации<br>
		<input type='text' style='width: 280px;' value='".$config['s_url']."registration.html&amp;ref=".$user_arr[0]."'><br><br>");
	echo("
	<table class='ap_list_table'>
		<tr>
			<td class='ap_list_table_td'>№</td>
			<td class='ap_list_table_td'>Логин</td>
			<td class='ap_list_table_td'>Доход</td>
	</tr>"); 
	$ref_arr=mysql_query("SELECT `id`,`login`,`rbalance` FROM `users` WHERE `rid`='".$user_arr[0]."' ORDER BY `rbalance` DESC");
	if(mysql_num_rows($ref_arr)=="0")
	echo("
	<tr>
		<td colspan='3'>Нет рефералов</td>
	</tr>"); $i=1;
	while($row=mysql_fetch_array($ref_arr))
	{
		echo("<tr>
			<td>".$i."</td>
			<td>".$row[1]."</td>
			<td>".$row[2].str_replace("1","$",str_replace("2","руб.",$config['valuta']))."</td>
		</tr>"); $i=$i+1;
	}
	echo("</table><br><br>");
	unset($row,$ref_arr);
}
?>