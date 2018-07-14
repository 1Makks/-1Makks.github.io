<?php
@error_reporting(E_ALL, ~E_NOTICE); 
ob_start(); 
ini_set("allow_url_include","Off"); 
ini_set("allow_url_fopen","Off"); 
ini_set("register_globals","Off"); 
ini_set("safe_mode","On");
echo("document.write(\"<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js'></script>\"); ");
// Подгрузка ядра ///////////////////////////////////////////////
require_once("../config.php");
require_once("../".SOURCE_DIR."/config_db.php");
require_once("../".SOURCE_DIR."/init_db.php");
require_once("../".SOURCE_DIR."/init_source.php");
$adv_arr=mysql_fetch_array(mysql_query("SELECT `id`,`t`,`defban`,`lastdate`,`holdv` FROM `tables` WHERE `id`='".mysql_real_escape_string(intval($get_array['id']))."'"));
if($adv_arr[0]=="" OR $adv_arr[1]==1) exit;

if($get_array['s']=="")
$s=1;
else
$s=$get_array['s'];

if($s>2) exit;
if($s<1) exit;

$links_arr=mysql_query("SELECT `id`,`href`,`ban_href`,`lim`,`sid` FROM `abanner` WHERE `sid`='".$adv_arr[0]."' AND `status`=2 AND `sz`=".$s." ORDER BY `id` ASC LIMIT 1");
while($row=mysql_fetch_array($links_arr))
{
if($adv_arr[4]==1)
{
$query_arr1=mysql_fetch_array(mysql_query("SELECT `w`,`d` FROM `tables` WHERE `id`='".$adv_arr[0]."' "));
	?>
	$('.cod_ban_<?php echo($adv_arr[0]); ?>').append("<a href='<?php echo($config['s_url']."advert.html&sub=banner&undersub=add&id=".$adv_arr[0]); ?>' target='_blank'><img title='Заказать рекламу' alt='Заказать рекламу' src='http://buy-link.ru/img/add.png' style=position:absolute;'></a><a href='<?php echo(str_replace('<script>','',$row[1])); ?>' target='_blank'><img class='screenshot' alt='Место освободится <?php echo(str_replace('<script>','',$adv_arr[3])); ?>' title='Место освободится <?php echo(str_replace('<script>','',$adv_arr[3])); ?>' src='<?php echo(str_replace('<script>','',$row[2])); ?>' width='<?php echo($query_arr1[0].""); ?>' height='<?php echo($query_arr1[1].""); ?>' /></a>");
	<?php
}
else
{
$query_arr1=mysql_fetch_array(mysql_query("SELECT `w`,`d` FROM `tables` WHERE `id`='".$adv_arr[0]."' "));
	?>
	$('.cod_ban_<?php echo($adv_arr[0]); ?>').append("<a href='<?php echo(str_replace('<script>','',$row[1])); ?>' target='_blank'><img class='screenshot' alt='Место освободится <?php echo(str_replace('<script>','',$adv_arr[3])); ?>' title='Место освободится <?php echo(str_replace('<script>','',$adv_arr[3])); ?>' src='<?php echo(str_replace('<script>','',$row[2])); ?>' width='<?php echo($query_arr1[0].""); ?>' height='<?php echo($query_arr1[1].""); ?>' /></a>");
	<?php
}

}
if(mysql_num_rows($links_arr)==0 AND $s==1)
{
$query_arr1=mysql_fetch_array(mysql_query("SELECT `w`,`d` FROM `tables` WHERE `id`='".$adv_arr[0]."' "));
	?>
	$('.cod_ban_<?php echo($adv_arr[0]); ?>').append("<a href='<?php echo($config['s_url']."advert.html&sub=banner&undersub=add&id=".$adv_arr[0]); ?>' target='_blank'><img src='<?php echo($adv_arr[2]); ?>' width='<?php echo($query_arr1[0].""); ?>' height='<?php echo($query_arr1[1].""); ?>'></a>");
	<?php
}

// Завершаем работу mysql
mysql_close();

// Завершение работы
exit;

?>