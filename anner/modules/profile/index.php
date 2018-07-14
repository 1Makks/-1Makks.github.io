<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");

echo("<title>Профиль : ".$params_array[0]."</title>");

if(auth===FALSE)
{
	msg("Для доступа к данной странице необходима авторизация или <a href='/registration.html'>регистрация</a>! ","warning");
}
else
{
	if(count($post_array)>0)
	{
		if($post_array['icq']!="" AND strlen($post_array['icq'])>15)
        {
                $err="Некорректный ICQ-номер";
        }
        elseif($post_array['wmr']!="" AND !preg_match("/^R([0-9]{12})$/",$post_array['wmr']))
        {
                $err="Некоректный R-кошелек";
        }
        elseif($post_array['wmr']!="" AND strlen($post_array['wmr'])!=13)
        {
                $err="Некоректный R-кошелек";
        }
		$query_array=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM `users` WHERE `wmr`='".$post_array['wmr']."' AND `id`!='".$user_arr[0]."'"));
        if($query_array[0]>0 AND $post_array['wmr']!="")
        {
                $err="R-кошелек уже есть в системе";
        }
		if($post_array['oldpassw']!="" AND $post_array['oldpassw']!=md5($user_arr[2]))
		{
			$err="Неправильный старый пароль";
		}
		elseif(strlen($post_array['newpassw'])<6 AND $post_array['newpassw']!="")
        {
               $err="Длинна пароля должна быть больше 6-ти символов";
        }
        elseif($post_array['newpassw']!=$post_array['new2passw'])
        {
                $err="Пароли не совпадают";
        }
        elseif(strlen($post_array['newpassw'])>30)
        {
                $err="Длинна пароля не жолжна быть больше 30-ти символов";
        }
        if($err!="")
        {
                msg($err,"warning");
        }
        else
        {
			if($post_array['newpassw']!="")
			{
				$pwd=",`passw`='".md5($post_array['newpassw'])."'";
			}
			$upgrade=mysql_query("UPDATE `users` SET 
			`icq`='".intval($post_array['icq'])."',
			`wmr`='".$post_array['wmr']."'".$pwd." WHERE `id`='".$user_arr[0]."'");
			if($upgrade) msg("Данные обновлены!","succes"); else msg("Ошибка при работе с базой данных!","warning");
        }
	}
	else
	{
		echo("<b>Профиль:</b><br><br>
		<form action='profile.html' method='POST'>
			<table>
				<tr>
					<td>Логин</td><td><input type='text' DISABLED value='".$user_arr[1]."'></td>
				</tr>
				<tr>
					<td>Email</td><td><input type='text' DISABLED value='".$user_arr[3]."'></td>
				</tr>
				<tr>
					<td>WMR</td><td>"); 
                                                        if($user_arr[9]=="") 
                                                        {
                                                           echo("<input type='text' name='wmr' value='".$user_arr[9]."'>");
                                                        }
                                                           else
                                                        {
                                                           echo("<input type='text' name='wmr' DISABLED value='".$user_arr[9]."'>");
                                                        }

                                                        echo("</td>
				</tr>
				<tr>
					<td>ICQ</td><td><input type='text' name='icq' value='".$user_arr[8]."'></td>
				</tr>
				<tr>
					<td><br /><b>Смена пароля:</b></td><td><br /></td>
				</tr>
				<tr>
					<td><br />Новый пароль</td><td><br /><input type='password' name='newpassw'></td>
				</tr>
				<tr>
					<td>Повторно</td><td><input type='password' name='new2passw'></td>
				</tr>
				<tr>
				<td colspan='2'><input type='submit' value='Изменить'></td>
			</tr>
			</table>
		</form>
		<br><br>");
	}
}
?>