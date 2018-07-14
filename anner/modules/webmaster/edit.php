<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");

echo("<title>Витрины : ".$params_array[0]."</title>");

if(auth===FALSE)
{
	msg("Для доступа к данной странице необходима авторизация или <a href='/registration.html'>регистрация</a>!","warning");
}
else
{
	$num_arr=mysql_fetch_array(mysql_query("SELECT * FROM `tables` WHERE `id`='".mysql_real_escape_string($get_array['id'])."' AND `uid`='".$user_arr[0]."'"));
	if($num_arr[0]=="")
	{
		msg("Объявление с таким ID нет, либо не пренадлежит вам!","warning");
	}
	else
	{
		if(count($post_array)!=0)
		{
			if($post_array['name']=="")
			{
				$err="Ошибка! Введите Название витрины";
			}
			if(strlen($post_array['name'])>500)
			{
				$err="Ошибка! Длинна поля Название витрины привышает 500 символов";
			}
                             if($num_arr[3]==2)
                                 {
                                          if($post_array['price']<1)
			{
				$err="Ошибка! Цена покупки баннера не менее 1 руб";
			}
                                          if($post_array['defban']=="http://" OR $post_array['defban']=="")
			{
				$err="Ошибка! Введите URL заглушки";
			}
                                          if(strlen($post_array['defban'])>400)
			{
				$err="Ошибка! Длинна поля URL заглушки превышает 500 символов";
			}
			if(strlen($post_array['atext'])>201)
			{
				$err="Ошибка! Длинна Описания сайта превышает 200 символов";
			}
			if($post_array['w']<0)
			{
				$err="Ошибка! Размер баннера по широте должен > 0";
			}
			if($post_array['d']<0)
			{
				$err="Ошибка! Размер баннера по высоте должен > 0";
			}
                                  }
			if($post_array['svoi']==1)
			{
		              $codes=$post_array['codes'];
			}
		              else
			{
		              $codes=0;
			}
			if($post_array['price']<1)
			{
				$err="Ошибка! Цена покупки ссылок не менее 1 руб";
			}
			if($post_array['linknum']<1 AND $num_arr[3]==1)
			{
				$err="Ошибка! Количество ссылок > 1";
			}
			if($post_array['linknum']>50  AND $num_arr[3]==1)
			{
				$err="Ошибка! Количество ссылок не более 50";
			}
                                          if($post_array['maxtext']<10 AND $num_arr[3]==1)
			{
				$err="Ошибка! Символов должно быть не менее 10 > 1";
			}
			if($post_array['maxtext']>100 AND $num_arr[3]==1)
			{
				$err="Ошибка! Символов должно быть не более 100";
			}
			if($err=="")
			{
				$update=mysql_query("UPDATE `tables` SET `url`=`url`,`linknum`='".$post_array['linknum']."',`price`='".floatval($post_array['price'])."',`defban`='".$post_array['defban']."',`maxtext`='".$post_array['maxtext']."',`slot`='".$post_array['slot']."',`forma`='".$post_array['forma']."',`name`='".$post_array['name']."',`dopol`='".$post_array['dopol']."',`c1`='".$post_array['red']."',`c2`='".$post_array['green']."',`c3`='".$post_array['blue']."',`c4`='".$post_array['orang']."',`svoi`='".$codes."',`holdv`='".$post_array['holdv']."',`atext`='".$post_array['atext']."' WHERE `id`='".$num_arr[0]."'");
				if($update) header("location: webmaster.html"); else msg("Ошибка при записи в бд","warning");
			}
			else
			{
				msg($err,"warning");
			}
		}
		else
		{
			echo("<b>Редактирование витрины ".$num_arr[2]."</b><br><br>
			<form action='' method='POST'>
				<table>
					<tr>
						<td>Название витрины</td><td>&nbsp;&nbsp;<input type='text' name='name' value='".$num_arr[13]."'></td>
					</tr>
					<tr>
						<td>Описание сайта</td><td><br>&nbsp;&nbsp;<textarea cols='45' rows='3' name='atext' maxlength='200'>".$num_arr[24]."</textarea></td>
					</tr>
					<tr>
						<td><br>URL сайта</td><td><br>&nbsp;&nbsp;<input type='text' DISABLED name='url' value='".$num_arr[2]."'></td>
					</tr>");
					if($num_arr[3]==1)
{
					echo("
					<tr>
						<td><br>Цена<a alt='В эту цену входит ".$config['sys']."% комиссии системы' title='В эту цену входит ".$config['sys']."% комиссии системы'>*</a></td><td><br>&nbsp;&nbsp;<input type='text' name='price' value='".$num_arr[5]."'>&nbsp;Целое число</td>
					</tr>
					<tr>
						<td><br>Выделение ссылки</td><td><br>&nbsp;
                                                                     <select name='dopol'>
						<option value='0'>Отключить</option>
						<option value='1' "); if($num_arr[15]==1) echo("selected"); echo(">1 рубль</option>
						<option value='2' "); if($num_arr[15]==2) echo("selected"); echo(">2 рубля</option>
						<option value='3' "); if($num_arr[15]==3) echo("selected"); echo(">3 рубля</option>
						<option value='4' "); if($num_arr[15]==4) echo("selected"); echo(">4 рубля</option>
						<option value='5' "); if($num_arr[15]==5) echo("selected"); echo(">5 рублей</option>
						<option value='6' "); if($num_arr[15]==6) echo("selected"); echo(">6 рублей</option>
						<option value='7' "); if($num_arr[15]==7) echo("selected"); echo(">7 рублей</option>
						<option value='8' "); if($num_arr[15]==8) echo("selected"); echo(">8 рублей</option>
						<option value='9' "); if($num_arr[15]==9) echo("selected"); echo(">9 рублей</option>
						<option value='10' "); if($num_arr[15]==10) echo("selected"); echo(">10 рублей</option>
						<option value='15' "); if($num_arr[15]==15) echo("selected"); echo(">15 рублей</option>
					</select></td>
					</tr>
					<tr>
						<td><br>Цвет выделения:</td><td>
<table>
<tr><td><br>&nbsp;&nbsp;Красный </td><td><br>&nbsp;&nbsp;<input type='radio' name='red' value='1' "); if($num_arr[18]==1) echo("checked='checked'"); echo("> ON </td><td><br>&nbsp;&nbsp;<input type='radio' name='red' value='0'"); if($num_arr[18]==0) echo("checked='checked'"); echo("> OFF</td></tr>
<tr><td>&nbsp;&nbsp;Зеленый </td><td>&nbsp;&nbsp;<input type='radio' name='green' value='1'"); if($num_arr[19]==1) echo("checked='checked'"); echo("> ON </td><td>&nbsp;&nbsp;<input type='radio' name='green' value='0' "); if($num_arr[19]==0) echo("checked='checked'"); echo("> OFF</td></tr>
<tr><td>&nbsp;&nbsp;Синий </td><td>&nbsp;&nbsp;<input type='radio' name='blue' value='1'"); if($num_arr[20]==1) echo("checked='checked'"); echo("> ON </td><td>&nbsp;&nbsp;<input type='radio' name='blue' value='0' "); if($num_arr[20]==0) echo("checked='checked'"); echo("> OFF</td></tr>
<tr><td>&nbsp;&nbsp;Оранжевый </td><td>&nbsp;&nbsp;<input type='radio' name='orang' value='1'"); if($num_arr[21]==1) echo("checked='checked'"); echo("> ON </td><td>&nbsp;&nbsp;<input type='radio' name='orang' value='0' "); if($num_arr[21]==0) echo("checked='checked'"); echo("> OFF</td></tr>
<tr><td><br>&nbsp;&nbsp;Свой </td><td><br>&nbsp;&nbsp;<input type='radio' name='svoi' value='1'"); if($num_arr[22]!='0') echo("checked='checked'"); echo("> ON </td><td><br>&nbsp;&nbsp;<input type='radio' name='svoi' value='0' "); if($num_arr[22]=='0') echo("checked='checked'"); echo("> OFF</td></tr>
<tr><td>&nbsp;&nbsp;Codes:</td><td colspan='2'>&nbsp;&nbsp;<input type='text' name='codes' value='$num_arr[22]' size='6' maxlength='6'></td></tr>
</table>

</td>
					</tr>
					<tr>
						<td><br>Вид витрины</td><td>"); if($num_arr[12]==1) echo("<br>&nbsp;&nbsp;<input type='radio' name='forma' value='1' checked='checked'> Вертикальная<br>&nbsp;&nbsp;<input type='radio' name='forma' value='2'> Горизонтальная"); else echo("<br>&nbsp;&nbsp;<input type='radio' name='forma' value='1'> Вертикальная<br>&nbsp;&nbsp;<input type='radio' name='forma' value='2' checked='checked'> Горизонтальная"); echo("</td>
					</tr>
					<tr>
						<td><br>Ссылок в блоке</td><td><br>&nbsp;&nbsp;<input type='text' name='linknum' value='".$num_arr[6]."'></td>
					</tr>
					<tr>
						<td><br>Длина текста ссылок</td><td><br>&nbsp;&nbsp;<input type='text' name='maxtext' value='".$num_arr[8]."'></td>
					</tr>");
}
					if($num_arr[3]==2)
{
					echo(" <tr>
						<td><br>Размер баннера px</td><td><br>&nbsp;&nbsp;<input DISABLED type='text' size='4' name='w' value='".$num_arr[9]."x".$num_arr[10]."'></td>
					</tr><tr>
						<td><br>URL баннера, место свободно</td><td><br>&nbsp;&nbsp;<input type='text' name='defban' value='".$num_arr[7]."'> (png, jpg, gif)</td>
					</tr><tr>
						<td><br>Цена за неделю<a alt='В эту цену входит ".$config['sys']."% комиссии системы' title='В эту цену входит ".$config['sys']."% комиссии системы'>*</a></td><td><br>&nbsp;&nbsp;<input type='text' name='price' value='".$num_arr[5]."'>&nbsp;Целое число</td>
					</tr>
					<tr>
						<td id='naim'><br>Баннеров в ротации:</td><td id='valu'><br>&nbsp;&nbsp;<input TRUE type='text' min='1' max='30' name='slot' value='".$num_arr[25]."' style='width:60px'> </td>
					</tr>");
}
					echo("
					<tr>
						<td colspan='2'><br><input type='submit' value='Изменить'></td>
					</tr>
				</table>
			</form>");
		}
	}
}
?>