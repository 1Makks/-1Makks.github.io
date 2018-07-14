<?php
if(!defined("AP")) exit();

// ini_set('display_errors', '0');

// IP пользователя ///////////////////////////////////////////////////
if(getenv("HTTP_CLIENT_IP"))
{
	$ip = getenv("HTTP_CLIENT_IP");
}
elseif(getenv("HTTP_X_FORWARDED_FOR"))
{
	$ip = getenv("HTTP_X_FORWARDED_FOR");
}
else
{
	$ip = getenv("REMOTE_ADDR");
}
$ip=mysql_real_escape_string($ip);

if($ip=="86.57.157.188") exit('Ошибка 502');

// GD :D //////////////////////////////////////////////////////////////
if(!function_exists("imagecreate")) exit("Необходима поддержка GD");

// Парсим настройки ///////////////////////////////////////////////////
$date=@date("d.m.Y H:i",time()+60*60*$params_array[2]);

// Проверка пользователя //////////////////////////////////////////////
if($_SESSION['uid']!="" AND $_SESSION['uip']==$ip)
{
	$user_arr=mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$_SESSION['uid']."'"));
	if($user_arr[0]!="") define("auth",true); else define("auth",false);
}
else define("auth",false);

// Фильтр POST,GET,COOKIES ////////////////////////////////////////////
$_GET=array_map('trim',$_GET);
$_POST=array_map('trim',$_POST);
$_COOKIE=array_map('trim',$_COOKIE);
if(get_magic_quotes_gpc())
{
	$_GET=array_map('stripslashes',$_GET);
	$_POST=array_map('stripslashes',$_POST);
	$_COOKIE=array_map('stripslashes',$_COOKIE);
}
foreach($_POST as $key => $value)
{
	$post_array[$key]=mysql_real_escape_string($value);
}
foreach($_GET as $key => $value)
{
	$get_array[$key]=mysql_real_escape_string($value);
}
foreach($_COOKIE as $key => $value)
{
	$cookie_array[$key]=mysql_real_escape_string($value);
}

// Функция сообщения //////////////////////////////////////////////////
function msg($msg,$level)
{
	echo("<div class='ap_msg_$level'>$msg</div>");
}

// Реферал /////////////////////////////////////////////////////////////
if($get_array['ref']!="")
{
	setcookie("ref",intval($get_array['ref']),time()+60*60*2);
	header("location: ".$config['s_url'].str_replace("?ref=".intval($get_array['ref']),"",str_replace("&ref=".intval($get_array['ref']),"",$_SERVER['REQUEST_URI'])));
}

if($user_arr[0]!=0) $banned='';
// $baned='Уважаемые вебмастеры, просьба заменить старые коды витрин, что непосредственно ускорит загрузку ваших проектов и исключит зависание при нестабильной работе нашего сервера. Обновления продолжаются.';


?>
