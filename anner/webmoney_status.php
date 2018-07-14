<?php
require("config.php");
require("source/config_db.php");
require("source/init_db.php");

IF($_POST['LMI_PREREQUEST']==1)
{
	// Неистовый троллинг мудаков, пытающихся сменить кошелек при оплате
	if(trim($_POST['LMI_PAYEE_PURSE'])!=$config['wmr']) 
	{
		echo "ERR: НЕВЕРНЫЙ КОШЕЛЕК ПОЛУЧАТЕЛЯ ".$_POST['LMI_PAYEE_PURSE'];
		exit;
	}
	echo "YES";
}
ELSE
{
	// Неистовый троллинг мудаков, пытающихся сменить кошелек при оплате
	if(trim($_POST['LMI_PAYEE_PURSE'])!=$config['wmr'])
	{
		echo "ERR: НЕВЕРНЫЙ КОШЕЛЕК ПОЛУЧАТЕЛЯ ".$_POST['LMI_PAYEE_PURSE'];
		exit;
	}
	// ТРОЛОЛО И ДРУГИЕ ПРИКЛЮЧЕНИЯ ХЕША
	$secret_key = $config['secret_key'];
	
	$common_string = $_POST['LMI_PAYEE_PURSE'].$_POST['LMI_PAYMENT_AMOUNT'].$_POST['LMI_PAYMENT_NO'].
    $_POST['LMI_MODE'].$_POST['LMI_SYS_INVS_NO'].$_POST['LMI_SYS_TRANS_NO'].
    $_POST['LMI_SYS_TRANS_DATE'].$secret_key.$_POST['LMI_PAYER_PURSE'].$_POST['LMI_PAYER_WM'];
	
	$hash = strtoupper(md5($common_string));
	
	// Прикинуться мертвым если палево
	if($hash!=$_POST['LMI_HASH']) exit;
  
	// Неистовый ТРОЛОЛО на тип покупаемого

              $balanss=intval($_POST['LMI_PAYMENT_AMOUNT'])*0.05;

	if($_POST['type']==5)
	{
                            $insert8=mysql_query("INSERT INTO `money` VALUES (NULL,'".intval($_POST['user'])."','".date("d.m.Y H:i")."','".$_POST['LMI_PAYMENT_AMOUNT']."')");
		$upd=mysql_query("UPDATE `users` SET `balance`=balance+".round((($_POST['LMI_PAYMENT_AMOUNT']-$balanss)),2)." WHERE `id`='".intval($_POST['user'])."'");
$balanns4=mysql_fetch_array(mysql_query("SELECT `balance` FROM `users` WHERE `id`='".intval($_POST['user'])."'"));		
$statistic4=mysql_query("INSERT INTO `statistic` VALUES (NULL,'".intval($_POST['user'])."','4','".date("d.m.Y H:i")."','".round(floatval($_POST['LMI_PAYMENT_AMOUNT']-$balanss),2)."','".$balanns4[0]."','0','0','0','0')");
		if(!$upd) exit("ошибка");
		echo "YES";
	}

	if($_POST['type']==1)
	{
		// ОЛОЛО чтобы не ананировали с кодом страницы
		$count_arr=mysql_fetch_array(mysql_query("SELECT `id`,`linknum`,`price`,`uid`,`url`,`lastdate` FROM `tables` WHERE `id`=".intval($_POST['lid']).""));
		if($count_arr[0]=="") exit("ошибка");

                            $ceno=($count_arr[2]*intval($_POST['week']))+($count_arr[2]*intval($_POST['week'])*0.05);		
                            $cenno=$count_arr[2]*intval($_POST['week'])*0.05;

// if($_POST['week']!=1 OR $_POST['week']!=2 OR $_POST['week']!=3 OR $_POST['week']!=4) exit("ERR: ошибка");

		if($_POST['LMI_PAYMENT_AMOUNT']!=$ceno) exit("ERR: ошибка");

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
			$d=$dd1+7*intval($_POST['week']);
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
		$insert=mysql_query("INSERT INTO `abanner` VALUES
			(NULL,'".$user_arr[0]."','".$count_arr[0]."','".urldecode($_POST['sid'])."','".urldecode($_POST['txt'])."',2,'".$d.".".$m.".".$y." ".$hh1.":".$ii1."',1,'".$count_arr[2]*intval($_POST['week'])."','".$hold."',0)");

		$select_arr=mysql_fetch_array(mysql_query("SELECT `rid` FROM `users` WHERE `id`='".intval($_POST['uid'])."'"));

                   $last=mysql_query("UPDATE `tables` SET `lastdate`='0' WHERE `id`='".intval($_POST['lid'])."'");
   
		if($select_arr[0]!="")
		{
			$updr=mysql_query("UPDATE `users` SET `balance`=balance+".round((floatval($_POST['LMI_PAYMENT_AMOUNT']-$cenno)/100*$config['refp']),2)." WHERE `id`='".$select_arr[0]."'");
			$updr=mysql_query("UPDATE `users` SET `rbalance`=rbalance+".round((($_POST['LMI_PAYMENT_AMOUNT']-$cenno)/100*$config['refp']),2)." WHERE `id`='".intval($_POST['uid'])."'");
		}

if($hold==1)
{
$upd=mysql_query("UPDATE `users` SET `hold`=hold+".round(floatval($_POST['LMI_PAYMENT_AMOUNT']-$cenno),2)." WHERE `id`='".$count_arr[3]."'");
$balanns1=mysql_fetch_array(mysql_query("SELECT `balance` FROM `users` WHERE `id`='".intval($_POST['uid'])."'"));		
$statistic1=mysql_query("INSERT INTO `statistic` VALUES (NULL,'".intval($_POST['uid'])."','5','".date("d.m.Y H:i")."','".round(floatval($_POST['LMI_PAYMENT_AMOUNT']-$cenno),2)."','".$balanns1[0]."','".$_POST['LMI_PAYER_PURSE']."','".urldecode($_POST['sid'])."','".urldecode($_POST['txt'])."','".$count_arr[0]."')");
}
else
{
$upd=mysql_query("UPDATE `users` SET `balance`=balance+".round(floatval($_POST['LMI_PAYMENT_AMOUNT']-$cenno),2)." WHERE `id`='".$count_arr[3]."'");
$balanns1=mysql_fetch_array(mysql_query("SELECT `balance` FROM `users` WHERE `id`='".intval($_POST['uid'])."'"));		
$statistic1=mysql_query("INSERT INTO `statistic` VALUES (NULL,'".intval($_POST['uid'])."','1','".date("d.m.Y H:i")."','".round(floatval($_POST['LMI_PAYMENT_AMOUNT']-$cenno),2)."','".$balanns1[0]."','".$_POST['LMI_PAYER_PURSE']."','".urldecode($_POST['sid'])."','".urldecode($_POST['txt'])."','".$count_arr[0]."')");
}


                            if(!$upd) exit("ошибка");
		echo "YES";
	}
	else
	{

		// ОЛОЛО чтобы не ананировали с кодом страницы
		$count_arr=mysql_fetch_array(mysql_query("SELECT `id`,`linknum`,`price`,`uid`,`url`,`dopol`,`svoi`,`maxtext` FROM `tables` WHERE `id`=".intval($_POST['lid']).""));
		if($count_arr[0]=="") exit("ошибка");


                            $cena=($count_arr[2]+intval($_POST['dopol']))+(($count_arr[2]+intval($_POST['dopol']))*0.05);
                            $cenna=($count_arr[2]+intval($_POST['dopol']))*0.05;
                            $myc=$count_arr[2]+intval($_POST['dopol']);

		if($_POST['dopol']<0 OR $_POST['dopol']>15) exit("ERR: ошибка");
		if($_POST['LMI_PAYMENT_AMOUNT']!=$cena) exit("ERR: ошибка");
		
		// Подрочить колвоссылок и удалить нахуй ненужную
		$link2_arr=mysql_query("SELECT `id` FROM `alink` WHERE `sid`='".$count_arr[0]."' ORDER BY `id` ASC");
		$link_arr=mysql_fetch_array(mysql_query("SELECT `id` FROM `alink` WHERE `sid`='".$count_arr[0]."' ORDER BY `id` ASC LIMIT 1"));
		if(mysql_num_rows($link2_arr)>=$count_arr[1] AND $count_arr[0]!="")
		{
			$sid=$link_arr[0];
		}
		
		// Доставляет

$a1=$_POST['sid'];
$a2=urldecode($_POST['txt']);
$a3=$count_arr[7];

$a1=substr("$a1", 0, 255);
$a2=substr("$a2", 0, $a3);

		$insert=mysql_query("INSERT INTO `alink` VALUES 
			(NULL,'".$user_arr[0]."','".$count_arr[0]."','".urldecode($a1)."','".urldecode($a2)."',2,'".date("d.m.Y H:i")."','".$myc."','".intval($_POST['dopol'])."','".$_POST['cvet']."',0)");
			
		$select_arr=mysql_fetch_array(mysql_query("SELECT `rid` FROM `users` WHERE `id`='".intval($_POST['uid'])."'"));
   
		if($select_arr[0]!="")
		{
			$updr=mysql_query("UPDATE `users` SET `balance`=balance+".round((floatval($_POST['LMI_PAYMENT_AMOUNT']-$cenna)/100*$config['refp']),2)." WHERE `id`='".$select_arr[0]."'");
			$updr=mysql_query("UPDATE `users` SET `rbalance`=rbalance+".round((($_POST['LMI_PAYMENT_AMOUNT']-$cenna)/100*$config['refp']),2)." WHERE `id`='".intval($_POST['uid'])."'");
		}
		$del=mysql_query("DELETE FROM `alink` WHERE `id`='".$sid."'");
		$upd=mysql_query("UPDATE `users` SET `balance`=balance+".round(floatval($_POST['LMI_PAYMENT_AMOUNT']-$cenna),2)." WHERE `id`='".$count_arr[3]."'");
$balanns=mysql_fetch_array(mysql_query("SELECT `balance` FROM `users` WHERE `id`='".intval($_POST['uid'])."'"));		
$statistic=mysql_query("INSERT INTO `statistic` VALUES (NULL,'".intval($_POST['uid'])."','1','".date("d.m.Y H:i")."','".round(floatval($_POST['LMI_PAYMENT_AMOUNT']-$cenna),2)."','".$balanns[0]."','".$_POST['LMI_PAYER_PURSE']."','".urldecode($a1)."','".urldecode($a2)."','".$count_arr[0]."')");
		if(!$upd) exit("ошибка");
		echo "YES";
	}
}
?>