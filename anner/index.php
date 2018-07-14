<?php 
@error_reporting(E_ALL, ~E_NOTICE); 
ob_start(); @session_start(); 
ini_set("allow_url_include","Off"); 
ini_set("allow_url_fopen","Off"); 
ini_set("register_globals","Off"); 
ini_set("safe_mode","On"); 
require_once("config.php"); 
require_once(SOURCE_DIR."/config_db.php"); 
require_once(SOURCE_DIR."/init_db.php"); 
require_once(SOURCE_DIR."/init_source.php"); 
/*
$key = $config['key']; $key = base64_decode($key); 
$key2 = $config['key2']; $key2 = base64_decode($key2); 
$codes = 'y+j25e3n6P8g7eUg4Ory6OLo8O7i4O3gISDE6/8g7+7r8/fl7ej/IOvo9uXt5+ju7e3u4+4g6uv+9+AsIO7h8ODy6PLl8fwg6iDv7uv85+7i4PLl6/4gQ2FzcGVyIO3gIPHg6fLlIE5lb1NrcmlwdC5ydQ=='; 
$stop = base64_decode($codes); 
$domen = strtoupper($_SERVER["HTTP_HOST"]); 
if($_SERVER["HTTP_HOST"]!= $key && $_SERVER["HTTP_HOST"]!= $key2) 
{ 
exit ("<div style='font-size:40px; padding-top:100px; text-align:center; font-weight:bold;'>$stop</div>"); 
} 
*/
require_once("template/booter.php"); 
if(!preg_match("/^([a-z]{0,10})+$/",$get_array['page']))
 exit;
 if(!preg_match("/^([a-z]{0,10})+$/",$get_array['sub'])) 
 exit; 
 if(!preg_match("/^([a-z]{0,10})+$/",$get_array['undersub'])) 
 exit; if($get_array['page']=="") 
 { 
 if(!file_exists("modules/index/index.php")) header("location: /index.php"); 
 else 
 require("modules/index/index.php"); 
 } 
 else { if($get_array['sub']=="") 
 { 
 if(!file_exists("modules/".$get_array['page']."/index.php")) header("location: /index.php");
 else 
 require("modules/".$get_array['page']."/index.php"); 
 } 
 else 
 { 
 if($get_array['undersub']=="") 
 { 
 if(!file_exists("modules/".$get_array['page']."/".$get_array['sub'].".php")) header("location: /index.php");
 else require("modules/".$get_array['page']."/".$get_array['sub'].".php"); }
 else 
 { 
 if(!file_exists("modules/".$get_array['page']."/".$get_array['sub']."/".$get_array['undersub'].".php")) header("location: /index.php"); 
 else 
 require("modules/".$get_array['page']."/".$get_array['sub']."/".$get_array['undersub'].".php"); 
     } 
   } 
  } 
  require_once("template/footer.php"); 
  ?>