<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");

echo("<title>Пополнение : ".$params_array[0]."</title>");

if(auth===FALSE)
{
	echo("Для доступа к данной странице необходима авторизация или <a href='/registration.html'>регистрация</a>! ");
}
else
{

                 if($post_array['pod']==0)
{
		if($post_array['summa']>$user_arr[5])
		{
			exit("ERR: Недостаточно средств на балансе");
		}
                            $count_arr=mysql_fetch_array(mysql_query("SELECT `price`,`uid` FROM `tables` WHERE `id`='".mysql_real_escape_string($post_array['lid'])."'"));
		if($user_arr[0]==$count_arr[1])
		{
			exit("ERR: Вы не можете купить ссылку у самого себя");
		}
		if(($post_array['lid']==$count_arr[0])&&($post_array['lid']!=1))
		{
			exit("ERR: Ошибка стоимости");
		}
		if($err=="")
		{


		$count_arr=mysql_fetch_array(mysql_query("SELECT `id`,`linknum`,`price`,`uid`,`url`,`maxtext` FROM `tables` WHERE `id`=".mysql_real_escape_string(intval($post_array['lid'])).""));
		if($count_arr[0]=="") exit("ошибка");

                            $cenna=($count_arr[2]+intval($post_array['dopol']));

		if($post_array['dopol']<0 OR $post_array['dopol']>15) exit("ERR: ошибка");
		if($post_array['summa']!=$cenna) exit("ERR: ошибка");
	
		$link2_arr=mysql_query("SELECT `id` FROM `alink` WHERE `sid`='".$count_arr[0]."' ORDER BY `id` ASC");
		$link_arr=mysql_fetch_array(mysql_query("SELECT `id` FROM `alink` WHERE `sid`='".$count_arr[0]."' ORDER BY `id` ASC LIMIT 1"));
		if(mysql_num_rows($link2_arr)>=$count_arr[1] AND $count_arr[0]!="")
		{
			$sid=$link_arr[0];
		}

$a1=$post_array['sid'];
$a2=urldecode($post_array['txt']);	
$a3=$count_arr[5];

$a1=substr("$a1", 0, 255);
$a2=substr("$a2", 0, $a3);

		$insert=mysql_query("INSERT INTO `alink` VALUES 
			(NULL,'".$user_arr[0]."','".$count_arr[0]."','".urldecode($a1)."','".urldecode($a2)."',2,'".date("d.m.Y H:i")."','".$post_array['summa']."','".intval($post_array['dopol'])."','".$post_array['cvet']."',0)");

                           $insert1=mysql_query("INSERT INTO `money` VALUES (NULL,'".$user_arr[0]."','".date("d.m.Y H:i")."','".$post_array['summa']."')");			

		$del=mysql_query("DELETE FROM `alink` WHERE `id`='".$sid."'");

		$upd=mysql_query("UPDATE `users` SET `balance`=balance+".floatval(round($post_array['summa'], 2))." WHERE `id`='".$count_arr[3]."'");
		if(!$upd) exit("ошибка");

		$upp=mysql_query("UPDATE `users` SET `balance`=balance-".floatval(round($cenna, 2))." WHERE `id`='".$user_arr[0]."'");
$balanns2=mysql_fetch_array(mysql_query("SELECT `balance` FROM `users` WHERE `id`='".$user_arr[0]."'"));		
$statistic2=mysql_query("INSERT INTO `statistic` VALUES (NULL,'".$user_arr[0]."','3','".date("d.m.Y H:i")."','".floatval(round($cenna, 2))."','".$balanns2[0]."','".$count_arr[3]."','".urldecode($a1)."','".urldecode($a2)."','".$count_arr[0]."')");

$balanns3=mysql_fetch_array(mysql_query("SELECT `balance` FROM `users` WHERE `id`='".$count_arr[3]."'"));		
$statistic3=mysql_query("INSERT INTO `statistic` VALUES (NULL,'".$count_arr[3]."','1','".date("d.m.Y H:i")."','".floatval(round($cenna, 2))."','".$balanns3[0]."','".$user_arr[0]."','".urldecode($a1)."','".urldecode($a2)."','".$count_arr[0]."')");

		if($upp) header("location: /success.html"); else header("location: /fail.html");







		}
		else
		{
			msg($err,"warning");
		}
}
else
{
echo("Оплата покупки через баланс системы.<br />Стоимость ".$post_array['summa']." руб.*<br /><br />

<form action='' method='POST'>
<input type=hidden name='lid' value='".$post_array['lid']."'>
<input type=hidden name='summa' value='".$post_array['summa']."'>
<input type='hidden' name='uid' value='".$post_array['uid']."'>
<input type='hidden' name='sid' value='".$post_array['sid']."'>
<input type='hidden' name='txt' value='".$post_array['txt']."'>
<input type='hidden' name='dopol' value='".$post_array['dopol']."'>
<input type='hidden' name='cvet' value='".$post_array['cvet']."'>
<input type=hidden name='pod' value='0'>
<input type='submit' value='Подтвердить'></form>
<br /><br />
* Комиссия 0%<br />");

}

}
?>