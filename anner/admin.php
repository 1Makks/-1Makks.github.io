<?php
////////////////////////////////////////////
@error_reporting(E_ALL, ~E_NOTICE); 
ob_start(); 
session_start();
ini_set("allow_url_include","Off"); 
ini_set("allow_url_fopen","Off"); 
ini_set("register_globals","Off"); 
ini_set("safe_mode","On");

// Подгрузка ядра ///////////////////////////////////////////////
require_once("config.php");
require_once(SOURCE_DIR."/config_db.php");
require_once(SOURCE_DIR."/init_db.php");
require_once(SOURCE_DIR."/init_source.php");
require_once("template/booter.php");
echo("<title>Админка : ".$params_array[0]."</title>");

// Пользователь //////////////////////////////////////////////////
if($user_arr[0]=="" OR $user_arr[4]!=2)
{
	header("location: /");
}

// Парсинг страниц ///////////////////////////////////////////////

if($get_array['page']=="")
{
	if(!file_exists("modules/".$config['admin']."/index/index.php")) header("location: /");
	else require("modules/".$config['admin']."/index/index.php");
}
else
{
	if($get_array['sub']=="")
	{
		if(!file_exists("modules/".$config['admin']."/".$get_array['page']."/index.php")) header("location: /");
		else require("modules/".$config['admin']."/".$get_array['page']."/index.php");
	}
	else
	{
		if($get_array['undersub']=="")
		{
			if(!file_exists("modules/".$config['admin']."/".$get_array['page']."/".$get_array['sub'].".php")) header("location: /");
			else require("modules/".$config['admin']."/".$get_array['page']."/".$get_array['sub'].".php");
		}
		else
		{
			if(!file_exists("modules/".$config['admin']."/".$get_array['page']."/".$get_array['sub']."/".$get_array['undersub'].".php")) header("location: /");
			else require("modules/".$config['admin']."/".$get_array['page']."/".$get_array['sub']."/".$get_array['undersub'].".php");
		}
	}
}
require_once("template/footer.php");
?>
