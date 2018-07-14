<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");


if(count($post_array)>0)
	{
			$query=mysql_fetch_array(mysql_query("SELECT `id`,`login` FROM `users` WHERE `".$post_array['user']."`='".$post_array['to']."' "));
			if($query) echo("<a href='/".$config['admin'].".php?page=users&sub=info&id=$query[0]'>$query[1]</a>"); else msg("Ошибка при поиске!","warning");
	}
	else
	{
		
echo("Поиск пользователей:<br/><br/><form action='' method='POST'>



<select name='user' size='1' multiple>
<option value='id'>ID</option>
<option value='login'>LOGIN</option>
<option value='email'>E-MAIL</option>
<option value='wmr'>WMR</option>
<option value='icq'>ICQ</option>
<option value='ip'>IP</option>
<option value='lastip'>LASTIP</option>
</select>

<input type='text' name='to'><input type='submit' value='Искать'></form>");
	}
?>