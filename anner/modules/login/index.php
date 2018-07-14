<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");

echo("<title>Авторизация : ".$params_array[0]."</title>");

$_SESSION['uip']=$ip;
$dat=date("H:i");
$five=mysql_query("DELETE FROM `avtoriz` WHERE `schet`>'4' AND `date`<'".$dat."'");

$one=mysql_fetch_array(mysql_query("SELECT `ip`,`date`,`schet` FROM `avtoriz` WHERE `ip`='$ip'"));

if($one[2]>4)
{
	exit("Ошибка, Вы неправильно ввели пароль 5 раза. Попробуйте войти через 1 час.");
}
if($post_array['passw']=="" OR $post_array['login']=="")
{
	$err="Заполните все поля";
}
$query_array=mysql_fetch_array(mysql_query("SELECT `id` FROM `users` WHERE `login`='".$post_array['login']."' AND `passw`='".md5($post_array['passw'])."'"));
if($query_array[0]=="")
{
	$err="Пользователь с таким логином и паролем не найден!";
}
if($err=="")
{
	$_SESSION['uid']=$query_array[0];
	$_SESSION['uip']=$ip;
              $four=mysql_query("DELETE FROM `avtoriz` WHERE `ip`='$ip'");
              $query=mysql_query("UPDATE `users` SET `lastdate`='".date("d.m.Y H:i")."' WHERE `login`='".$post_array['login']."'");
              $query=mysql_query("UPDATE `users` SET `lastip`='".$ip."' WHERE `login`='".$post_array['login']."'");
	header("location: /webmaster.html");
}
else
{


if($one==0)
{
$two=mysql_query("INSERT INTO `avtoriz` VALUES (NULL,'$ip','0','1')"); 
$one=mysql_fetch_array(mysql_query("SELECT `ip`,`date`,`schet` FROM `avtoriz` WHERE `ip`='$ip'"));             
}
else
{
if($one[2]<5)
{
$one[2]=$one[2]+1;

$H=date("H");
$i=date("i");
if($H==23)
{
$H=00;
}
else
{
$H=$H+1;
}

$frie=mysql_query("UPDATE `avtoriz` SET `schet`='$one[2]',`date`='".$H.":".$i."' WHERE `ip`='$ip'");
}

}



	msg($err,"warning");
}
?>
