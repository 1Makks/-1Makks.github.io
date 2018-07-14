<?php
require("config.php");
require("source/config_db.php");
require("source/init_db.php");
// as a part of ResultURL script

// your registration data
$mrh_pass2 = $config['mrh_pass2']; // merchant pass2 here

// HTTP parameters:
$out_summ = $_REQUEST["OutSum"];
$inv_id = $_REQUEST["InvId"];
$crc = $_REQUEST["SignatureValue"];
$shp_item = $_REQUEST["Shp_item"];
$shp_item2 = $_REQUEST["Shp_item2"];
$shp_item3 = $_REQUEST["Shp_item3"];
$shp_item4 = $_REQUEST["Shp_item4"];
$shp_item5 = $_REQUEST["Shp_item5"];
$shp_item6 = $_REQUEST["Shp_item6"];

// HTTP parameters: $out_summ, $inv_id, $crc
$crc = strtoupper($crc); // force uppercase

// build own CRC
$my_crc = strtoupper(md5("$out_summ:$inv_id:$mrh_pass2:Shp_item=$shp_item:Shp_item2=$shp_item2:Shp_item3=$shp_item3:Shp_item4=$shp_item4:Shp_item5=$shp_item5:Shp_item6=$shp_item6"));

if (strtoupper($my_crc) != strtoupper($crc))
{
echo "bad sign\n";
exit();
}

	// Тип покупаемого

              $balanss=intval($out_summ)*0.05;

	if($_POST['Shp_item4']==5)
	{
		$upd=mysql_query("UPDATE `users` SET `balance`=balance+".round((($out_summ-$balanss)),2)." WHERE `id`='".intval($_POST['Shp_item'])."'");
$balanns7=mysql_fetch_array(mysql_query("SELECT `balance` FROM `users` WHERE `id`='".intval($_POST['Shp_item'])."'"));		
$statistic7=mysql_query("INSERT INTO `statistic` VALUES (NULL,'".intval($_POST['Shp_item'])."','4','".date("d.m.Y H:i")."','".round(floatval($out_summ-$balanss),2)."','".$balanns7[0]."','0','0','0','0')");
		if(!$upd) exit("ошибка");
		echo "OK$inv_id\n";
	}

	if($_POST['Shp_item4']==1)
	{
		//Чтобы не ананировали с кодом страницы
		$count_arr=mysql_fetch_array(mysql_query("SELECT `id`,`linknum`,`price`,`uid`,`url`,`lastdate` FROM `tables` WHERE `id`=".intval($_POST['Shp_item']).""));
		if($count_arr[0]=="") exit("ошибка");

                            $ceno=($count_arr[2]*$shp_item5)+($count_arr[2]*$shp_item5*0.05);		
                            $cenno=$count_arr[2]*$shp_item5*0.05;		

// if($shp_item5!=1 OR $shp_item5!=2 OR $shp_item5!=3 OR $shp_item5!=4) exit("ERR: ошибка");
		if($out_summ!=$ceno) exit("ERR: ошибка");
		

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
			$d=$dd1+7*$shp_item5;
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


//Перекодировка
$lol1=$shp_item3;
$lol2=iconv('utf-8', 'windows-1251', $lol1);
$lol3=$shp_item2;
$lol4=iconv('utf-8', 'windows-1251', $lol3);


		// Доставляет
		$insert=mysql_query("INSERT INTO `abanner` VALUES
			(NULL,'".$user_arr[0]."','".$count_arr[0]."','".$lol2."','".$lol4."',2,'".$d.".".$m.".".$y." ".$hh1.":".$ii1."',1,'".$count_arr[2]*intval($shp_item5)."','".$hold."',0)");

		$select_arr=mysql_fetch_array(mysql_query("SELECT `rid` FROM `users` WHERE `id`='".intval($count_arr[3])."'"));

                   $last=mysql_query("UPDATE `tables` SET `lastdate`='0' WHERE `id`='".intval($_POST['Shp_item'])."'");   

		if($select_arr[0]!="")
		{
			$updr=mysql_query("UPDATE `users` SET `balance`=balance+".round((floatval($out_summ-$cenno)/100*$config['refp']),2)." WHERE `id`='".$select_arr[0]."'");
			$updr=mysql_query("UPDATE `users` SET `rbalance`=rbalance+".round((($out_summ-$cenno)/100*$config['refp']),2)." WHERE `id`='".$count_arr[3]."'");
		}

if($hold==1)
{
$upd=mysql_query("UPDATE `users` SET `hold`=hold+".round(floatval($out_summ-$cenno),2)." WHERE `id`='".$count_arr[3]."'");
$balanns1=mysql_fetch_array(mysql_query("SELECT `balance` FROM `users` WHERE `id`='".$count_arr[3]."'"));		
$statistic1=mysql_query("INSERT INTO `statistic` VALUES (NULL,'".$count_arr[3]."','5','".date("d.m.Y H:i")."','".round(floatval($out_summ-$cenno),2)."','".$balanns1[0]."','0','".$lol2."','".$lol4."','".$count_arr[0]."')");
}
else
{
$upd=mysql_query("UPDATE `users` SET `balance`=balance+".round(floatval($out_summ-$cenno),2)." WHERE `id`='".$count_arr[3]."'");
$balanns1=mysql_fetch_array(mysql_query("SELECT `balance` FROM `users` WHERE `id`='".$count_arr[3]."'"));		
$statistic1=mysql_query("INSERT INTO `statistic` VALUES (NULL,'".$count_arr[3]."','1','".date("d.m.Y H:i")."','".round(floatval($out_summ-$cenno),2)."','".$balanns1[0]."','0','".$lol2."','".$lol4."','".$count_arr[0]."')");
}
		
if(!$upd) exit("ошибка");
		echo "OK$inv_id\n";
	}
	else
	{
		//Чтобы не ананировали с кодом страницы
		$count_arr=mysql_fetch_array(mysql_query("SELECT `id`,`linknum`,`price`,`uid`,`url`,`dopol`,`maxtext` FROM `tables` WHERE `id`=".intval($_POST['Shp_item']).""));
		if($count_arr[0]=="") exit("ошибка");

                            $cena=($count_arr[2]+$shp_item5)+(($count_arr[2]+$shp_item5)*0.05);
                            $cenna=($count_arr[2]+$shp_item5)*0.05;
                            $myc=$count_arr[2]+$shp_item5;		

		if($shp_item5<0 OR $shp_item5>15) exit("ERR: ошибка");
		if($out_summ!=$cena) exit("ERR: ошибка");
		
		// Колвоссылок и удалить ненужную
		$link2_arr=mysql_query("SELECT `id` FROM `alink` WHERE `sid`='".$count_arr[0]."' ORDER BY `id` ASC");
		$link_arr=mysql_fetch_array(mysql_query("SELECT `id` FROM `alink` WHERE `sid`='".$count_arr[0]."' ORDER BY `id` ASC LIMIT 1"));
		if(mysql_num_rows($link2_arr)>=$count_arr[1] AND $count_arr[0]!="")
		{
			$sid=$link_arr[0];
		}	

//перекодировка
$lol1=$shp_item3;
$lol2=iconv('utf-8', 'windows-1251', $lol1);
$lol3=$shp_item2;
$lol4=iconv('utf-8', 'windows-1251', $lol3);



$a1=$count_arr[6];

$lol4=substr("$lol4", 0, 255);
$lol2=substr("$lol2", 0, $a1);


		// Доставляет
		$insert=mysql_query("INSERT INTO `alink` VALUES 
			(NULL,'".$user_arr[0]."','".$count_arr[0]."','".$lol4."','".$lol2."',2,'".date("d.m.Y H:i")."','".$myc."','$shp_item5','$shp_item6'),0");
			
		$select_arr=mysql_fetch_array(mysql_query("SELECT `rid` FROM `users` WHERE `id`='".intval($count_arr[3])."'"));
   
		if($select_arr[0]!="")
		{
			$updr=mysql_query("UPDATE `users` SET `balance`=balance+".round((floatval($out_summ-$cenna)/100*$config['refp']),2)." WHERE `id`='".$select_arr[0]."'");
			$updr=mysql_query("UPDATE `users` SET `rbalance`=rbalance+".round((($out_summ-$cenna)/100*$config['refp']),2)." WHERE `id`='".$count_arr[3]."'");
		}
		$del=mysql_query("DELETE FROM `alink` WHERE `id`='".$sid."'");
		$upd=mysql_query("UPDATE `users` SET `balance`=balance+".round(floatval($out_summ-$cenna),2)." WHERE `id`='".$count_arr[3]."'");
$balanns=mysql_fetch_array(mysql_query("SELECT `balance` FROM `users` WHERE `id`='".$count_arr[3]."'"));		
$statistic=mysql_query("INSERT INTO `statistic` VALUES (NULL,'".$count_arr[3]."','1','".date("d.m.Y H:i")."','".round(floatval($out_summ-$cenna),2)."','".$balanns[0]."','0','".$lol4."','".$lol2."','".$count_arr[0]."')");
if(!$upd) exit("ошибка");
		echo "OK$inv_id\n";
	}


?>