<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");

echo("<title>Тикеты : ".$params_array[0]."</title>");

if(auth===FALSE)
{
	msg("Для доступа к данной странице необходима авторизация или <a href='/registration.html'>регистрация</a>!","warning");
}
else
{

if($user_arr[0]==4723 OR $user_arr[0]==3217) 
{
msg("Доступ к разделу Тикеты ограничен, по причине: многочисленного спама!","warning"); 
exit();
}

if(count($post_array)!=0)
		{
			if($post_array['text']=="")
			{
				$err="Введите текст";
			}
                                          if(strlen($post_array['text'])>500)
			{
				$err="(500 символов максимум)";
			}
			if($err=="")
			{
				$insert=mysql_query("INSERT INTO `tickets` VALUES (NULL,'".$user_arr[0]."','".$post_array['text']."','','".date("d.m.Y H:i")."')");
				if($insert) header("location: /tickets.html"); else msg("Ошибка при записи в базу данных!","warning");
			}
			else
			{
				msg($err,"warning");
			}
		}
		else
		{
			echo("
			<form action='' method='POST'>
				<b>Тикеты:</b>
				<p></p>
                                                        <table>
					<tr>
						<td colspan='2'>Сообщение<br><textarea cols='68' rows='8' name='text'></textarea></td>
					</tr>
					<tr>
						<td colspan='2'><input type='submit' value='Отправить'></td>
					</tr>
				</table>
			</form>");
		}
	echo("<br>
	<table class='ap_list_table'>
		<tr>
			<td class='ap_list_table_td'>ID</td>
			<td class='ap_list_table_td'>Ваше сообщение</td>
			<td class='ap_list_table_td'>Ответ</td>
	</tr>");
	$site_arr=mysql_query("SELECT * FROM `tickets` WHERE `uid`='".mysql_real_escape_string($user_arr[0])."' ORDER BY `id` ASC");
	if(mysql_num_rows($site_arr)=="0")
	echo("
	<tr>
		<td colspan='3'>Нет тикетов</td>
	</tr>");
$nom=1;
	while($row=mysql_fetch_array($site_arr))


	{
		echo("<tr>
			<td>".$nom."</td>
			<td width='50%'>".$row[2]."</td>
                                          <td width='50%'>".$row[3]."</td>
		</tr>");
$nom=$nom+1;
	}
	echo("</table>
 
               <br><br>");
	unset($row,$site_arr);
}
?>