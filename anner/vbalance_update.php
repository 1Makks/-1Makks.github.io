<?php
require("config.php");
require("source/config_db.php");
require("source/init_db.php");

IF($_POST['LMI_PREREQUEST']==1)
{

	if(trim($_POST['LMI_PAYEE_PURSE'])!=$config['wmr']) 
	{
		echo "ERR: НЕВЕРНЫЙ КОШЕЛЕК ПОЛУЧАТЕЛЯ ".$_POST['LMI_PAYEE_PURSE'];
		exit;
	}
	echo "YES";
}
ELSE
{

	if(trim($_POST['LMI_PAYEE_PURSE'])!=$config['wmr'])
	{
		echo "ERR: НЕВЕРНЫЙ КОШЕЛЕК ПОЛУЧАТЕЛЯ ".$_POST['LMI_PAYEE_PURSE'];
		exit;
	}

	$secret_key=$config['secret_key'];
	
	$common_string = $_POST['LMI_PAYEE_PURSE'].$_POST['LMI_PAYMENT_AMOUNT'].$_POST['LMI_PAYMENT_NO'].
    $_POST['LMI_MODE'].$_POST['LMI_SYS_INVS_NO'].$_POST['LMI_SYS_TRANS_NO'].
    $_POST['LMI_SYS_TRANS_DATE'].$secret_key.$_POST['LMI_PAYER_PURSE'].$_POST['LMI_PAYER_WM'];
	
	$hash = strtoupper(md5($common_string));
	

	if($hash!=$_POST['LMI_HASH']) exit;
  
  
    $cenna=(intval($_POST['LMI_PAYMENT_AMOUNT']))*0.05;

	if($_POST['type']==1)
	{
		$upd=mysql_query("UPDATE `users` SET `balance`=balance+".round((($_POST['LMI_PAYMENT_AMOUNT']-$cenna)),4)." WHERE `id`='".intval($_POST['uid'])."'");
		if(!$upd) exit("ошибка");
		echo "YES";
	}
}
?>