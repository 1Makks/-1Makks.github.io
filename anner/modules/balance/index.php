<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");

echo("<title>Платежи : ".$params_array[0]."</title>");

if(auth===FALSE)
{
	msg("Для доступа к данной странице необходима авторизация или <a href='/registration.html'>регистрация</a>! ","warning");
}
else
{
$sumk=$user_arr[5]-$user_arr[5]*0.05;
	echo("
	<form action='balance.html&sub=add' method='POST'>
		<b>Платежи:</b><p></p>
                            Вывод производится в течение суток, через Webmoney на R кошелек.<br>
                            Минимум для снятия: ".$config['minsumm']." рублей. Комиссия системы ".$config['sys']."% будет снята при заказе выплат.<br><br>
		Сумма <input type='text' name='summa' onkeyup=$('#summa').html((this.value)-(this.value)*0.05) value='".$user_arr[5]."'> <input type='submit' value='Заказать'><br><br>Учитывая комиссию, вам зачислят: <span id='summa'>".$sumk."</span> руб.<br><br>
	</form>
	<table class='ap_list_table'>
		<tr>
			<td class='ap_list_table_td'>№</td>
			<td class='ap_list_table_td'>Дата</td>
			<td class='ap_list_table_td'>Кошелек</td>
			<td class='ap_list_table_td'>Сумма</td>
			<td class='ap_list_table_td'>Статус</td>
	</tr>");
	$site_arr=mysql_query("SELECT `id`,`date`,`r`,`status`,`summa` FROM `outbalance` WHERE `uid`='".mysql_real_escape_string($user_arr[0])."' ORDER BY `id` DESC");
	if(mysql_num_rows($site_arr)=="0")
	echo("
	<tr>
		<td colspan='3'>Нет платежей</td>
	</tr>"); $i=1;
	while($row=mysql_fetch_array($site_arr))
	{
		echo("<tr>
			<td>".$i."</td>
			<td>".$row[1]."</td>
			<td>".$row[2]."</td>
			<td>".$row[4]." руб.</td>
			<td>"); 
			if($row[3]==1) echo("<img src='template/apimages/warning.png'> Модерация"); 
			elseif($row[3]==2) echo("<img src='/template/apimages/ok.png'> Оплачено"); 
			else echo("<img src='template/apimages/banned.png'> Ошибка"); echo("</td>
		</tr>"); $i=$i+1;
	}
	echo("</table>");
	unset($row,$site_arr);
}
?>