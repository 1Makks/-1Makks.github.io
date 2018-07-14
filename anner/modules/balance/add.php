<?php
error_reporting(E_ALL);if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");

echo("<title>Выплаты : ".$params_array[0]."</title>");

if(auth===FALSE)
{
	msg("Для доступа к данной странице необходима авторизация или <a href='/registration.html'>регистрация</a>! ","warning");
}
else
{
	if(count($post_array)!=0)
	{
		if($post_array['summa']<$config['minsumm'])
		{
			$err="Сумма меньше минимальной";
		}
		if($post_array['summa']>$user_arr[5])
		{
			$err="Недостаточно средств";
		}
		if($user_arr[9]=="")
		{
			$err="Не введен R-кошелек";
		}
		if($err=="")
		{
$$post_array['summa']=mysql_real_escape_string($post_array['summa']);
                                          $top1=mysql_fetch_array(mysql_query("SELECT `tops` FROM `users` WHERE `id`='".$user_arr[0]."'"));
                                          $top1[0]=$top1[0]+($post_array['summa']-($post_array['summa']/100)*5);
			$r=round(($user_arr[5]-$post_array['summa']),4);
			$upd=mysql_query("UPDATE `users` SET `balance`='".$r."' WHERE `id`='".$user_arr[0]."'");
			$insert=mysql_query("INSERT INTO `outbalance` VALUES (NULL,'".$user_arr[0]."','".$date."','".$user_arr[9]."','".round($post_array['summa']-(($post_array['summa']/100)*$config['sys']),2)."',1)");
			$top2=mysql_query("UPDATE `users` SET `tops`='".$top1[0]."' WHERE `id`='".$user_arr[0]."'");
$balanns=mysql_fetch_array(mysql_query("SELECT `balance` FROM `users` WHERE `id`='".$user_arr[0]."'"));				              
$statistic=mysql_query("INSERT INTO `statistic` VALUES (NULL,'".$user_arr[0]."','2','".date("d.m.Y H:i")."','".$post_array['summa']."','$balanns[0]','0','0','0','0')");

			if($insert AND $upd) header("location: balance.html"); else msg("Ошибка при записи в базу данных","warning");
		}
		else
		{
			msg($err,"warning");
		}
	}
}
?>