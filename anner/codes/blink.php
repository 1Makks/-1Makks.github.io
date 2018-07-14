<?php
@error_reporting(E_ALL, ~E_NOTICE); 
ob_start(); 
ini_set("allow_url_include","Off"); 
ini_set("allow_url_fopen","Off"); 
ini_set("register_globals","Off"); 
ini_set("safe_mode","On");

// Подгрузка ядра ///////////////////////////////////////////////
require_once("../config.php");
require_once("../".SOURCE_DIR."/config_db.php");
require_once("../".SOURCE_DIR."/init_db.php");
require_once("../".SOURCE_DIR."/init_source.php");
$adv_arr=mysql_fetch_array(mysql_query("SELECT `id`,`t`,`forma`,`linknum` FROM `tables` WHERE `id`='".mysql_real_escape_string(intval($get_array['id']))."'"));
if($adv_arr[0]=="" OR $adv_arr[1]==2) exit;


echo("document.write(\"<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js'></script>\"); ");

$links_arr=mysql_query("SELECT `id`,`href`,`text`,`dopol`,`cvet` FROM `alink` WHERE `sid`='".$adv_arr[0]."' AND `status`=2 ORDER BY `id` DESC LIMIT $adv_arr[3]");

if($adv_arr[2]==1 OR $adv_arr[2]==0)
{
while($row=mysql_fetch_array($links_arr))
{


if($row[3]==0)
{
	?>
	$('.cod_link_<?php echo($adv_arr[0]); ?>').append("<a href='<?php echo(str_replace('<script>','',$row[1])); ?>' target='_blank'><?php echo(str_replace('<script>','',$row[2])); ?></a><br>");
	<?php
}
else
{

if($row[4]=='0')
{
$colo='red';
} 
elseif($row[4]=='1')
{
$colo='red';
} 
elseif($row[4]=='2') 
{
$colo='green';
}
elseif($row[4]=='3') 
{
$colo='blue';
}
elseif($row[4]=='4') 
{
$colo='orange';
}
else
{
$colo=$row[4];
}

	?>
	$('.cod_link_<?php echo($adv_arr[0]); ?>').append("<a href='<?php echo(str_replace('<script>','',$row[1])); ?>' target='_blank'><b><font color='<?php echo(str_replace('<script>','',$colo)); ?>'><?php echo(str_replace('<script>','',$row[2])); ?></font></b></a><br>");
	<?php
}
}

}


if($adv_arr[2]==2)
{
while($row=mysql_fetch_array($links_arr))
{
if($row[3]==0)
{
	?>
	$('.cod_link_<?php echo($adv_arr[0]); ?>').append("| <a href='<?php echo(str_replace('<script>','',$row[1])); ?>' target='_blank'><?php echo(str_replace('<script>','',$row[2])); ?></a>");
	<?php
}
else
{
if($row[4]=='1' OR $row[4]=='0')
{
$colo='red';
} 
elseif($row[4]=='2') 
{
$colo='green';
}
elseif($row[4]=='3') 
{
$colo='blue';
}
elseif($row[4]=='4') 
{
$colo='orange';
}
else
{
$colo=$row[4];
}
	?>
	$('.cod_link_<?php echo($adv_arr[0]); ?>').append("| <a href='<?php echo(str_replace('<script>','',$row[1])); ?>' target='_blank'><b><font color='<?php echo(str_replace('<script>','',$colo)); ?>'><?php echo(str_replace('<script>','',$row[2])); ?></font></b></a>");
	<?php
}
}

}

// Завершаем работу mysql
mysql_close();

// Завершение работы
exit;


?>