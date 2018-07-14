<?php
if(!defined("AP")) exit("ƒоступ к файлу напр¤мую запрещен!");

echo("<title>¬итрины : ".$params_array[0]."</title>");

if(auth===FALSE)
{
	msg("ƒл¤ доступа к данной странице необходима авторизаци¤ или <a href='/registration.html'>регистраци¤</a>!","warning");
}
else
{


$num_arr=mysql_fetch_array(mysql_query("SELECT `id`,`href`,`text`,`sid` FROM `alink` WHERE `id`='".mysql_real_escape_string(intval($get_array['id']))."'"));
$num_arr1=mysql_query("SELECT `id` FROM `tables` WHERE `id`='".$num_arr[3]."' AND `uid`='".$user_arr[0]."'");

if(mysql_num_rows($num_arr1)=="0")
{
echo("ќбъ¤вление с таким ID нет, либо не пренадлежит вам");
}
else
{	

	if($num_arr[0]=="" AND $num_arr1[0]=="")
	{
		msg("ќбъ¤вление с таким ID нет, либо не пренадлежит вам","warning");
	}
	else
	{
		if(count($post_array)!=0)
		{
			if($post_array['text']=="")
			{
				$err="ќшибка! ¬ведите текст ссылки";
			}
			if(strlen($post_array['url'])>500)
			{
				$err="ќшибка! ƒлинна текста ссылки привышает 500 символов";
			}
			if($err=="")
			{
				$update=mysql_query("UPDATE `alink` SET `text`='".$post_array['text']."' WHERE `id`='".$num_arr[0]."'");
				if($update) header("location: webmaster.html"); else msg("ќшибка при записи в бд","warning");
			}
			else
			{
				msg($err,"warning");
			}
		}
		else
		{
			echo("<b>–едактирование текста ссылки <a href='".$num_arr[1]."'>".$num_arr[2]."</a></b><br><br>
			<form action='' method='POST'>
				<table>
					<tr>
						<td>“екст</td><td>&nbsp;&nbsp;<input type='text' name='text' size='30' value='".$num_arr[2]."'></td>
					</tr>");
					echo("
					<tr>
						<td colspan='2'><br><input type='submit' value='«аменить'></td>
					</tr>
				</table>
			</form>");
		}
	}
}
}
?>