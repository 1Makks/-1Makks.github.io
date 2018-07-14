<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");

if(count($post_array)>0)
	{
			$query=mysql_fetch_array(mysql_query("SELECT `id`,`url`,`uid` FROM `tables` WHERE `".$post_array['user1']."`='".$post_array['to1']."' "));
                                          $query1=mysql_fetch_array(mysql_query("SELECT `id`,`login` FROM `users` WHERE `id`='$query[2]' "));
			if($query) echo("<a href='/".$config['admin'].".php?page=users&sub=info&id=$query1[0]'>$query1[1]</a>"); else msg("Ошибка при поиске!","warning");
	}
	else
	{
		
echo("Поиск площадок:<br /><br /><form action='' method='POST'>



<select name='user1' size='1' multiple>
<option value='id'>ID</option>
<option value='url'>URL</option>
</select>

<input type='text' name='to1'><input type='submit' value='Искать'></form>");
	}
	?>