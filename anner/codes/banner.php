<?php
@error_reporting(E_ALL, ~E_NOTICE); 
ob_start(); 
ini_set("allow_url_include","Off"); 
ini_set("allow_url_fopen","Off"); 
ini_set("register_globals","Off"); 
ini_set("safe_mode","On");
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
$links_arr=mysql_query("SELECT `id`,`href`,`ban_href`,`lim`,`sid`,`views` FROM `abanner` WHERE `sid`='".$adv_arr[0]."' AND `status`=2 AND `sz`=".$s." ORDER BY `id` ASC LIMIT 1");
while($row=mysql_fetch_array($links_arr))
{
if($adv_arr[4]==1)
{
$query_arr1=mysql_fetch_array(mysql_query("SELECT `w`,`d`,`price`,`slot` FROM `tables` WHERE `id`='".$adv_arr[0]."' "));
$time_new = date( 'j.m.Y G:i',time());
$restors = mysql_query("select 
								* 
						from abanner 
						where (`sid`='".$adv_arr[0]."' AND `status`=2 AND `lim` > '".$time_new."') LIMIT ".$query_arr1[3]." ");
												
$is=1;
while($restors_s=mysql_fetch_array($restors))
{
	$masImfa[$is]['id'] = $restors_s['id'];
	$masImfa[$is]['uid'] = $restors_s['uid'];
	$masImfa[$is]['sid'] = $restors_s['sid'];
	$masImfa[$is]['href'] = $restors_s['href'];
	$masImfa[$is]['ban_href'] = $restors_s['ban_href'];
	$masImfa[$is]['status'] = $restors_s['status'];
	$masImfa[$is]['lim'] = $restors_s['lim'];
	$masImfa[$is]['sz'] = $restors_s['sz'];
	$masImfa[$is]['price'] = $restors_s['price'];
	$masImfa[$is]['hold'] = $restors_s['hold'];
	$masImfa[$is]['views'] = $restors_s['views'];
	$is++;
}
$count_masInfo = count($masImfa); 
if($count_masInfo>=$query_arr1[3]){
	$text_imfo = 0;
}else{
	$text_imfo = $query_arr1[3] - $count_masInfo;
}
if($count_masInfo==0)
{
}else{

$random_masInfo=rand(1,$count_masInfo);

$blo = $masImfa[$random_masInfo]['id'];
$banpict= $masImfa[$random_masInfo]['ban_href'];
$click= $masImfa[$random_masInfo]['views'];
}
	?>
	document.write("<a href='<?php echo($config['s_url']."advert.html&sub=banner&undersub=add&id=".$adv_arr[0]); ?>' target='_blank'><?php if($text_imfo!=0){ ?><img title='Свободно <?php echo $text_imfo; ?> из <?php echo $query_arr1[3]; ?> мест. Стоимость размещения <?php echo($query_arr1[2].""); ?> руб. за неделю.' alt='Занять очередь! Цена за неделю <?php echo($query_arr1[2].""); ?> руб.' src='<?php echo($config['s_url']); ?>/img/add.png' style='position:absolute;'><?php } ?></a><a href='<?php echo($config['s_url']."banner.php?link=".$row['id']); ?>' target='_blank'><img class='screenshot' alt='Переходов: <?php echo($click.""); ?>' title='Переходов: <?php echo($click.""); ?>' src='<?php echo($row['ban_href'].""); ?>' width='<?php echo($query_arr1[0].""); ?>' height='<?php echo($query_arr1[1].""); ?>' /></a>");
	<?php
}
else
{
$query_arr1=mysql_fetch_array(mysql_query("SELECT `w`,`d`,`price` FROM `tables` WHERE `id`='".$adv_arr[0]."' "));
	?>
	document.write("<a href='<?php echo($config['s_url']."advert.html&sub=banner&undersub=add&id=".$adv_arr[0]); ?>' target='_blank'><img title='Занять очередь! Цена за неделю <?php echo($query_arr1[2].""); ?> руб.' alt='Занять очередь! Цена за неделю <?php echo($query_arr1[2].""); ?> руб.' src='<?php echo($config['s_url']); ?>/img/add.png' style='position:absolute;'></a><a href='<?php echo($config['s_url']."banner.php?link=".$row['id']); ?>' target='_blank'><img class='screenshot' alt='Место освободится <?php echo(str_replace('<script>','',$row['lim'])); ?>' title='Место освободится <?php echo(str_replace('<script>','',$row['lim'])); ?> Переходов: <?php echo($row[5].""); ?>' src='<?php echo($row['ban_href'].""); ?>' width='<?php echo($query_arr1[0].""); ?>' height='<?php echo($query_arr1[1].""); ?>' /></a>");
	<?php
	/*	document.write("<a href='<?php echo($config['s_url']."advert.html&sub=banner&undersub=add&id=".$adv_arr[0]); ?>' target='_blank'><img title='Занять очередь! Цена за неделю <?php echo($query_arr1[2].""); ?> руб.' alt='Занять очередь! Цена за неделю <?php echo($query_arr1[2].""); ?> руб.' src='<?php echo($config['s_url']); ?>/img/add.png' style='position:absolute;'></a><a href='<?php echo($config['s_url']."banner.php?link=".$row['id']); ?>' target='_blank'><img class='screenshot' alt='Место освободится <?php echo(str_replace('<script>','',$row['lim'])); ?>' title='Место освободится <?php echo(str_replace('<script>','',$row['lim'])); ?> Переходов: <?php echo($row[5].""); ?>' src='<?php echo($row['ban_href'].""); ?>' width='<?php echo($query_arr1[0].""); ?>' height='<?php echo($query_arr1[1].""); ?>' /></a>"); */
}

}
if(mysql_num_rows($links_arr)==0 AND $s==1)
{
$query_arr1=mysql_fetch_array(mysql_query("SELECT `w`,`d`,`price` FROM `tables` WHERE `id`='".$adv_arr[0]."' "));

	?>
	document.write("<a href='<?php echo($config['s_url']."advert.html&sub=banner&undersub=add&id=".$adv_arr[0]); ?>' title='Место свободно! Цена за неделю <?php echo($query_arr1[2].""); ?> руб.' alt='Место свободно! Цена за неделю <?php echo($query_arr1[2].""); ?> руб.' target='_blank'><img src='<?php echo($adv_arr[2]); ?>' width='<?php echo($query_arr1[0].""); ?>' height='<?php echo($query_arr1[1].""); ?>'></a>");
	<?php
}

// Завершаем работу mysql
mysql_close();

// Завершение работы
exit;

?>