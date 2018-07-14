<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");

echo("<title>Пополнение баланса : ".$params_array[0]."</title>");

if(auth===FALSE)
{
	msg("Для доступа к данной странице необходима авторизация или <a href='/registration.html'>регистрация</a>!","warning");
}
else
{
	echo("
	<form action='money.html&sub=add' method='POST'>
		<b>Пополнение баланса:</b><p></p>
                            Комиссия системы ".$config['sys']."%<br><br>
		Сумма (в рублях): <input type='text' name='summa' value='10'> <input type='submit' value='Пополнить'><br><br>
	</form>");
}
?>