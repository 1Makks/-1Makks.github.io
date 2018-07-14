<?php
error_reporting(E_ALL);if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");

echo("<title>Пополнение : ".$params_array[0]."</title>");

if(auth===FALSE)
{
	msg("Для доступа к данной странице необходима авторизация или <a href='/registration.html'>регистрация</a>! ","warning");
}
else
{

                 if($post_array['pod']==0)
{
		if(($post_array['summa'])>$user_arr[5])
		{
			exit("Ошибка: Недостаточно средств на балансе");
		}
                            $count_arr=mysql_fetch_array(mysql_query("SELECT `price`,`uid` FROM `tables` WHERE `id`='".mysql_real_escape_string($post_array['lid'])."'"));
		if($post_array['lid']==$count_arr[0])
		{
			exit("Ошибка: Ошибка стоимости");
		}
		if($user_arr[0]==$count_arr[1])
		{
			exit("Ошибка: Вы не можете купить баннер у себя");
		}
		if($err=="")
		{







$count_arr=mysql_fetch_array(mysql_query("SELECT `id`,`linknum`,`price`,`uid`,`url`,`lastdate` FROM `tables` WHERE `id`=".mysql_real_escape_string(intval($post_array['lid'])).""));
		if($count_arr[0]=="") exit("ошибка");

                            $cenna=$count_arr[2]*intval($post_array['week']);

// if($post_array['week']!=1 OR $post_array['week']!=2 OR $post_array['week']!=3 OR $post_array['week']!=4) exit("ERR: ошибка");
		if($post_array['summa']!=$cenna) exit("Ошибка: ошибка");

if($count_arr[5]==0)
{
$count_arr[5]=date("d.m.Y H:i");
$dd1=date("d");
$mm1=date("m");
$yy1=date("Y");
$hh1=date("H");
$ii1=date("i");
$hold=0;
}
else
{
$dd1=substr("$count_arr[5]", 0, 2);
$mm1=substr("$count_arr[5]", 3, 2);
$yy1=substr("$count_arr[5]", 6, 4);

$hh1=substr("$count_arr[5]", 11, 2);
$ii1=substr("$count_arr[5]", 14, 2);
$hold=1;
}

		$m=$mm1;
		$y=$yy1;
			$d=$dd1+7*intval($post_array['week']);
			if($d>28 AND $m==2)
			{
				$m++;
				$d=$d-28;
			}
			elseif($d>30 AND ($m==4 OR $m==6 OR $m==9 OR $m==11))
			{
				$m++;
				$d=$d-30;
			}
			elseif($d>31 AND ($m==1 OR $m==3 OR $m==5 OR $m==7 OR $m==8 OR $m==10))
			{
				$m++;
				$d=$d-31;
			}
			elseif($d>31 AND $m==12)
			{
				$y++;
				$m=$m-11;
				$d=$d-31;
			}


                            if($m<10 AND $m!=$mm1) $m="0".$m;
                            if($d<10 AND $d!=$dd1) $d="0".$d;


		// Доставляет
		$insert5=mysql_query("INSERT INTO `abanner` VALUES
			(NULL,'".$user_arr[0]."','".$count_arr[0]."','".urldecode($post_array['sid'])."','".urldecode($post_array['txt'])."',2,'".$d.".".$m.".".$y." ".$hh1.":".$ii1."',1,'".$count_arr[2]*intval($post_array['week'])."','".$hold."',0)");

                           $insert4=mysql_query("INSERT INTO `money` VALUES (NULL,'".$user_arr[0]."','".date("d.m.Y H:i")."','".mysql_real_escape_string($post_array['summa'])."')");



                   $last=mysql_query("UPDATE `tables` SET `lastdate`='0' WHERE `id`='".mysql_real_escape_string(intval($post_array['lid']))."'");

if($hold==1)
{

$upp=mysql_query("UPDATE `users` SET `hold`=hold+".floatval(round($post_array['summa'], 2))." WHERE `id`='".$count_arr[3]."'");

$upd=mysql_query("UPDATE `users` SET `balance`=balance-".floatval(round($post_array['summa'], 2))." WHERE `id`='".$user_arr[0]."'");

$balanns6=mysql_fetch_array(mysql_query("SELECT `balance` FROM `users` WHERE `id`='".$user_arr[0]."'"));		
$statistic6=mysql_query("INSERT INTO `statistic` VALUES (NULL,'".$user_arr[0]."','3','".date("d.m.Y H:i")."','".floatval(round($post_array['summa'], 2))."','".$balanns6[0]."','".$count_arr[3]."','".urldecode($post_array['sid'])."','".urldecode($post_array['txt'])."','".$count_arr[0]."')");

$balanns9=mysql_fetch_array(mysql_query("SELECT `balance` FROM `users` WHERE `id`='".$count_arr[3]."'"));		
$statistic9=mysql_query("INSERT INTO `statistic` VALUES (NULL,'".$count_arr[3]."','5','".date("d.m.Y H:i")."','".floatval(round($post_array['summa'], 2))."','".$balanns9[0]."','".$user_arr[0]."','".urldecode($post_array['sid'])."','".urldecode($post_array['txt'])."','".$count_arr[0]."')");
}
else
{
$upd=mysql_query("UPDATE `users` SET `balance`=balance+".floatval(round($post_array['summa'], 2))." WHERE `id`='".$count_arr[3]."'");

$upp=mysql_query("UPDATE `users` SET `balance`=balance-".floatval(round($post_array['summa'], 2))." WHERE `id`='".$user_arr[0]."'");

$balanns6=mysql_fetch_array(mysql_query("SELECT `balance` FROM `users` WHERE `id`='".$user_arr[0]."'"));		
$statistic6=mysql_query("INSERT INTO `statistic` VALUES (NULL,'".$user_arr[0]."','3','".date("d.m.Y H:i")."','".floatval(round($post_array['summa'], 2))."','".$balanns6[0]."','".$count_arr[3]."','".urldecode($post_array['sid'])."','".urldecode($post_array['txt'])."','".$count_arr[0]."')");

$balanns9=mysql_fetch_array(mysql_query("SELECT `balance` FROM `users` WHERE `id`='".$count_arr[3]."'"));		
$statistic9=mysql_query("INSERT INTO `statistic` VALUES (NULL,'".$count_arr[3]."','1','".date("d.m.Y H:i")."','".floatval(round($post_array['summa'], 2))."','".$balanns9[0]."','".$user_arr[0]."','".urldecode($post_array['sid'])."','".urldecode($post_array['txt'])."','".$count_arr[0]."')");
}

		if($upp OR $upp15) header("location: /success.html"); else header("location: /fail.html");

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
<input type='hidden' name='week' value='".$post_array['week']."'>
<input type='hidden' name='txt' value='".$post_array['txt']."'>
<input type=hidden name='pod' value='0'>
<input type='submit' value='Подтвердить'></form>
<br /><br />
* Комиссия 0%<br />");

}

}
?>