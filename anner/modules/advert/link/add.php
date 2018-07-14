<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");

$omgr=1;

	if(count($post_array)!=0)
	{
		if($post_array['url']=="http://" OR $post_array['url']=="")
		{
			$err="Введите url сайта!";
		}

                   $http=substr($post_array['url'],0,7);

		if($http!="http://")
		{
			$err="Ошибка URL адрес без http://";
		}
		if($post_array['text']=="")
		{
			$err="Введите текст ссылки";
		}
		if(strlen($post_array['url'])>300)
		{
			$err="Длинна поля URL больше максимально допустимого (300 символов максимум)";
		}
		if(strlen($post_array['text'])>100)
		{
			$err="Длинна поля Текст больше максимально допустимого (100 символов максимум)";
		}
		if($post_array['sid']=="")
		{
			$err="Не выбран сайт";
		}
		
		if($post_array['url']=="http://u.to/")
		{
			$err="Данный сайт заблокирован системой";
		}
		$count_arr=mysql_fetch_array(mysql_query("SELECT `id`,`linknum`,`price`,`uid`,`url` FROM `tables` WHERE `id`=".mysql_real_escape_string(intval($post_array['sid'])).""));
		if($count_arr[0]=="")
		{
			$err="Нет такого сайта";
		}
		$_SESSION['price']=$count_arr[2];
		$link2_arr=mysql_query("SELECT `id` FROM `alink` WHERE `sid`='".$count_arr[0]."' ORDER BY `id` ASC");
		$link_arr=mysql_fetch_array(mysql_query("SELECT `id` FROM `alink` WHERE `sid`='".$count_arr[0]."' ORDER BY `id` ASC LIMIT 1"));
		if(mysql_num_rows($link2_arr)>=$count_arr[1] AND $count_arr[0]!="")
		{
			$sid=$link_arr[0];
		}
		if($err=="")
		{
			$lid=mysql_insert_id();
$cena=($count_arr[2]+$post_array['dopol'])+(($count_arr[2]+$post_array['dopol'])*0.05);
$cenas=($count_arr[2]+$post_array['dopol']);
$m_orderid = mt_rand(1,99999);
$post_array['url']=str_replace("http://http://","http://",$post_array['url']);

			echo("<br>

Убедитесь в правильности набора данных. После оплаты редактирование ссылки будет невозможным!<br><br>
                                          <table><tr><td>URL:</td><td>&nbsp;&nbsp;&nbsp;".htmlspecialchars($post_array['url'])."</td><td rowspan='2'><a href='".htmlspecialchars($post_array['url'])."' target='_blank'>".htmlspecialchars($post_array[''])."</a></tr>
                                           <tr><td><br>Текст:</td><td><br>"); 
if($post_array['dopol']==0)
{
$post_array['dopol']=0;
$post_array['cvet']=0;
echo("&nbsp;&nbsp;&nbsp;".htmlspecialchars($post_array['text'])."</td></tr><tr><td><br>Сумма:</td><td><br>&nbsp;&nbsp;&nbsp;".$cena." руб. с учетом комиссии</td></tr>");
}
else
{
echo("&nbsp;&nbsp;&nbsp;<b>"); 
if($post_array['cvet']==1) echo("<font color='red'>".htmlspecialchars($post_array['text'])."</font>"); 
elseif($post_array['cvet']==2) echo("<font color='green'>".htmlspecialchars($post_array['text'])."</font>"); 
elseif($post_array['cvet']==3) echo("<font color='blue'>".htmlspecialchars($post_array['text'])."</font>"); 
elseif($post_array['cvet']==4) echo("<font color='orange'>".htmlspecialchars($post_array['text'])."</font>"); 
else echo("<font color='".$post_array['cvet']."'>".htmlspecialchars($post_array['text'])."</font>"); 

echo("</b></td></tr><tr><td><br>Выделить:</td><td><br>&nbsp;&nbsp;&nbsp;&#10003;</td></tr><tr><td><br>Сумма:</td><td><br>&nbsp;&nbsp;&nbsp;".$cena." руб. с учетом комиссии</td></tr>");
}
                                           
echo("<tr><td colspan='2'><br><center><a href='/advert.html&sub=link&undersub=add&id=".$post_array['sid']."'>Изменить</a></center></td></tr></table>

            <br><br>Выберите способ оплаты:<br><br>");


echo("<form action='advert.html&sub=link&undersub=bal' method='POST'>
	             <input type='hidden' name='summa' value='$cenas'>
	             <input type='hidden' name='pod' value='1'>
                           <input type='hidden' name='id' value='$user_arr[0]'>
                           <input type='hidden' name='uid' value='".$count_arr[3]."'>
	             <input type='hidden' name='lid' value='".$count_arr[0]."'>
	             <input type='hidden' name='sid' value='".urlencode(htmlspecialchars($post_array['url']))."'>
	             <input type='hidden' name='txt' value='".urlencode(htmlspecialchars($post_array['text']))."'>
                           <input type='hidden' name='cvet' value='".$post_array['cvet']."'>
                           <input type='hidden' name='dopol' value='".htmlspecialchars($post_array['dopol'])."'>
                           <input type=image src='/template/balance.png'> - <i>без комиссии</i>
	</form>");
 // WebMoney---->

	

			
			
			
			
			$webmoney = $config['webmoney']; 
if($webmoney)
{
echo("			<form method='POST' action='https://merchant.webmoney.ru/lmi/payment.asp'>
            <input type='hidden' name='LMI_PAYMENT_NO' value='".$m_orderid."'>
            <input type='hidden' name='LMI_PAYMENT_AMOUNT' value='".$cena."'>
            <input type='hidden' name='LMI_PAYMENT_DESC' value='Оплата ".htmlspecialchars($post_array['url'])." ".htmlspecialchars($post_array['text']).", ".$count_arr[4]." id ".$count_arr[0]."'>
            <input type='hidden' name='LMI_PAYEE_PURSE' value='".$config['wmr']."'>
            <input type='hidden' name='uid' value='".$count_arr[3]."'>
			<input type='hidden' name='lid' value='".$count_arr[0]."'>
			<input type='hidden' name='sid' value='".urlencode(htmlspecialchars($post_array['url']))."'>
			<input type='hidden' name='txt' value='".urlencode(htmlspecialchars($post_array['text']))."'>
                             <input type='hidden' name='cvet' value='".$post_array['cvet']."'>
			<input type='hidden' name='dopol' value='".htmlspecialchars($post_array['dopol'])."'>
            <input type=image src='/template/webmoney.png'>
            </form>");
} else {
echo "";
}
            
	
			
// <----- WebMoney			
			
			
			
			
			
 // Payeer ---->
						   
						   
$desc = base64_encode($count_arr[3].'|||'.$count_arr[0].'|||'.urlencode(htmlspecialchars($post_array['url'])).'|||'.urlencode(htmlspecialchars($post_array['text'])).'|||0|||0|||0|||'.htmlspecialchars($post_array['dopol']).'|||'.$post_array['cvet']);
$m_shop =  $config['m_shop'];
$m_orderid = uniqid(rand(1000, 9999999));;
$m_amount = number_format($cena, 2, ".", "");
$m_curr = "RUB";
$m_desc = $desc;
$m_key = $config['m_key'];

$arHash = array(
 $m_shop,
 $m_orderid,
 $m_amount,
 $m_curr,
 $m_desc,
 $m_key
);
$sign = strtoupper(hash('sha256', implode(":", $arHash)));
$payeer = $config['payeer']; 
   if($payeer)
   {
      echo("
	<form method='GET' action='//payeer.com/api/merchant/m.php'>
	<input type='hidden' name='m_shop' value='$m_shop'>
	<input type='hidden' name='m_orderid' value='$m_orderid'>
	<input type='hidden' name='m_amount' value='$m_amount'>
	<input type='hidden' name='m_curr' value='RUB'>
	<input type='hidden' name='m_desc' value='$desc'>
	<input type='hidden' name='m_sign' value='$sign'>
	<input type=image src='/template/payeer.png'>
	</form>");
   } else {
      echo "";
   }              
// <----- Payeer			
			
			

			

   //  Robokassa ---->
// регистрационная информация (логин, пароль #1)
// registration info (login, password #1)
$mrh_login = $config['mrh_login'];
$mrh_pass1 = $config['mrh_pass1'];


// номер заказа
// number of order
$inv_id = 0;

// описание заказа
// order description
$inv_desc = "Оплата счета $cena, $user_arr[0]";

// сумма заказа
// sum of order
$out_summ = $cena;

// тип товара
// code of goods
$shp_item = $user_arr[0];
$shp_item2 = 0;
$shp_item3 = 0;
$shp_item4 = 5;
$shp_item5 = 0;
$shp_item6 = 0;
// предлагаемая валюта платежа
// default payment e-currency
$in_curr = "PCR";

// язык
// language
$culture = "ru";

// формирование подписи
// generate signature
$crc  = md5("$out_summ:$inv_id:$mrh_pass1");
$crc  = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1:Shp_item=$shp_item:Shp_item2=$shp_item2:Shp_item3=$shp_item3:Shp_item4=$shp_item4:Shp_item5=$shp_item5:Shp_item6=$shp_item6");
//$crc  = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1:Shp_item=$shp_item:Shp_item2=$shp_item2:Shp_item3=$shp_item3:t=1");

// форма оплаты товара
// payment form
$robokassa = $config['robokassa']; 
if($robokassa)
{
echo("<form action='https://merchant.roboxchange.com/Index.aspx' method=POST>
   <input type=hidden name=MrchLogin value=$mrh_login>
   <input type=hidden name=OutSum value=$out_summ>
   <input type=hidden name=InvId value=$inv_id>
   <input type=hidden name=Desc value='$inv_desc'>
   <input type=hidden name=SignatureValue value=$crc>
   <input type=hidden name=Shp_item value='$shp_item'>
  <input type=hidden name=Shp_item2 value='$shp_item2'>
  <input type=hidden name=Shp_item3 value='$shp_item3'>
  <input type=hidden name=Shp_item4 value='$shp_item4'>
  <input type=hidden name=Shp_item5 value='$shp_item5'>
  <input type=hidden name=Shp_item6 value='$shp_item6'>
  <input type=hidden name=IncCurrLabel value=$in_curr>
  <input type=hidden name=Culture value=$culture>
  <input type=image src='/template/robokassa.png'>
   </form>");
} else {
echo "";
}

// <----- Robokassa

// Яндекс Деньги ---->
// регистрационная информация (логин, пароль #1)
// registration info (login, password #1)
$mrh_login = $config['mrh_login'];
$mrh_pass1 = $config['mrh_pass1'];


// номер заказа
// number of order
$inv_id = 0;

// описание заказа
// order description
$inv_desc = "Оплата счета $cena, $user_arr[0]";

// сумма заказа
// sum of order
$out_summ = $cena;

// тип товара
// code of goods
$shp_item = $user_arr[0];
$shp_item2 = 0;
$shp_item3 = 0;
$shp_item4 = 5;
$shp_item5 = 0;
$shp_item6 = 0;
// предлагаемая валюта платежа
// default payment e-currency
$in_curr = "YandexMerchantR";

// язык
// language
$culture = "ru";

// формирование подписи
// generate signature
$crc  = md5("$out_summ:$inv_id:$mrh_pass1");
$crc  = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1:Shp_item=$shp_item:Shp_item2=$shp_item2:Shp_item3=$shp_item3:Shp_item4=$shp_item4:Shp_item5=$shp_item5:Shp_item6=$shp_item6");
//$crc  = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1:Shp_item=$shp_item:Shp_item2=$shp_item2:Shp_item3=$shp_item3:t=1");

// форма оплаты товара
// payment form
$robokassa = $config['yandex']; 
if($robokassa)
{
echo("<form action='https://merchant.roboxchange.com/Index.aspx' method=POST>
   <input type=hidden name=MrchLogin value=$mrh_login>
   <input type=hidden name=OutSum value=$out_summ>
   <input type=hidden name=InvId value=$inv_id>
   <input type=hidden name=Desc value='$inv_desc'>
   <input type=hidden name=SignatureValue value=$crc>
   <input type=hidden name=Shp_item value='$shp_item'>
  <input type=hidden name=Shp_item2 value='$shp_item2'>
  <input type=hidden name=Shp_item3 value='$shp_item3'>
  <input type=hidden name=Shp_item4 value='$shp_item4'>
  <input type=hidden name=Shp_item5 value='$shp_item5'>
  <input type=hidden name=Shp_item6 value='$shp_item6'>
  <input type=hidden name=IncCurrLabel value=$in_curr>
  <input type=hidden name=Culture value=$culture>
  <input type=image src='/template/yandex.png'>
   </form>");
} else {
echo "";
}

// <----- Яндекс Деньги


// QIWI ---->
// регистрационная информация (логин, пароль #1)
// registration info (login, password #1)
$mrh_login = $config['mrh_login'];
$mrh_pass1 = $config['mrh_pass1'];


// номер заказа
// number of order
$inv_id = 0;

// описание заказа
// order description
$inv_desc = "Оплата счета $cena, $user_arr[0]";

// сумма заказа
// sum of order
$out_summ = $cena;

// тип товара
// code of goods
$shp_item = $user_arr[0];
$shp_item2 = 0;
$shp_item3 = 0;
$shp_item4 = 5;
$shp_item5 = 0;
$shp_item6 = 0;
// предлагаемая валюта платежа
// default payment e-currency
$in_curr = "QiwiR";

// язык
// language
$culture = "ru";

// формирование подписи
// generate signature
$crc  = md5("$out_summ:$inv_id:$mrh_pass1");
$crc  = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1:Shp_item=$shp_item:Shp_item2=$shp_item2:Shp_item3=$shp_item3:Shp_item4=$shp_item4:Shp_item5=$shp_item5:Shp_item6=$shp_item6");
//$crc  = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1:Shp_item=$shp_item:Shp_item2=$shp_item2:Shp_item3=$shp_item3:t=1");

// форма оплаты товара
// payment form
$robokassa = $config['qiwi']; 
if($robokassa)
{
echo("<form action='https://merchant.roboxchange.com/Index.aspx' method=POST>
   <input type=hidden name=MrchLogin value=$mrh_login>
   <input type=hidden name=OutSum value=$out_summ>
   <input type=hidden name=InvId value=$inv_id>
   <input type=hidden name=Desc value='$inv_desc'>
   <input type=hidden name=SignatureValue value=$crc>
   <input type=hidden name=Shp_item value='$shp_item'>
  <input type=hidden name=Shp_item2 value='$shp_item2'>
  <input type=hidden name=Shp_item3 value='$shp_item3'>
  <input type=hidden name=Shp_item4 value='$shp_item4'>
  <input type=hidden name=Shp_item5 value='$shp_item5'>
  <input type=hidden name=Shp_item6 value='$shp_item6'>
  <input type=hidden name=IncCurrLabel value=$in_curr>
  <input type=hidden name=Culture value=$culture>
  <input type=image src='/template/qiwi.png'>
   </form>");
} else {
echo "";
}
// <----- QIWI





echo("<br><br>");

		}
		else
		{
			msg($err,"warning");
		}
	}
	else
	{
		echo("<form action='' method='POST'>
			");

			if($get_array['id']!=="") $o=" AND`id`='".intval($get_array['id'])."'";
			$site_arr=mysql_query("SELECT `id`,`url`,`price`,`linknum`,`maxtext`,`dopol`,`c1`,`c2`,`c3`,`c4`,`svoi`,`atext` FROM `tables` WHERE `status`=2 AND `t`=1".$o."");
			if(mysql_num_rows($site_arr)==0) echo header("location: /error.html");
			while($row=mysql_fetch_array($site_arr))
			{

$update7=mysql_fetch_array(mysql_query("SELECT `update` FROM `tables` WHERE `id`='$row[0]'"));
$pars2=mysql_fetch_array(mysql_query("SELECT `id` FROM `pars` WHERE `uid`='$row[0]'"));
if($pars2=="0" OR $update7[0]==0)

{



$url1=str_replace("http://","",$row[1]);
$url2=str_replace("www.", "", $url1); 
$url= str_replace("/","",$url2);



function listat($url)
{ 
$content = file_get_contents("http://counter.yadro.ru/values?site=".$url); 
preg_match_all("|LI_([^ ]+) = (\d*);|",$content,$ok); 
for($i=0; $i<count($ok[1]); $i++) $info[$ok[1][$i]]=$ok[2][$i]; 
return $info;
} 

//Использование 
$ff=listat($url); 
$w_vis=floor($ff[day_vis]); 
$w_hit=floor($ff[day_hit]);




     function urlinfo($url) 
     {  
      $ci_url = "http://bar-navig.yandex.ru/u?ver=2&show=32&url=http://www.$url/"; 
      $ci_data = implode("", file("$ci_url")); 
      preg_match("/value=\"(.\d*)\"/", $ci_data, $ci);
      return $ci[1]; 

     }
$saw=urlinfo($url);
    


$googlehost='toolbarqueries.google.com'; 
$googleua='Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.0.6) Gecko/20060728 Firefox/1.5'; 

function StrToNum($Str, $Check, $Magic) { 
 $Int32Unit = 4294967296; 

 $length = strlen($Str); 
 for ($i = 0; $i < $length; $i++) { 
 $Check *= $Magic; 
 if ($Check >= $Int32Unit) { 
 $Check = ($Check - $Int32Unit * (int) ($Check / $Int32Unit)); 
 $Check = ($Check < -2147483648) ? ($Check + $Int32Unit) : $Check; 
 } 
 $Check += ord($Str{$i}); 
 } 
 return $Check; 
} 

function HashURL($String) { 
 $Check1 = StrToNum($String, 0x1505, 0x21); 
 $Check2 = StrToNum($String, 0, 0x1003F); 

 $Check1 >>= 2; 
 $Check1 = (($Check1 >> 4) & 0x3FFFFC0 ) | ($Check1 & 0x3F); 
 $Check1 = (($Check1 >> 4) & 0x3FFC00 ) | ($Check1 & 0x3FF); 
 $Check1 = (($Check1 >> 4) & 0x3C000 ) | ($Check1 & 0x3FFF); 

 $T1 = (((($Check1 & 0x3C0) << 4) | ($Check1 & 0x3C)) <<2 ) | ($Check2 & 0xF0F ); 
 $T2 = (((($Check1 & 0xFFFFC000) << 4) | ($Check1 & 0x3C00)) << 0xA) | ($Check2 & 0xF0F0000 ); 

 return ($T1 | $T2); 
} 

function CheckHash($Hashnum) { 
 $CheckByte = 0; 
 $Flag = 0; 

 $HashStr = sprintf('%u', $Hashnum) ; 
 $length = strlen($HashStr); 

 for ($i = $length - 1; $i >= 0; $i --) { 
 $Re = $HashStr{$i}; 
 if (1 === ($Flag % 2)) { 
 $Re += $Re; 
 $Re = (int)($Re / 10) + ($Re % 10); 
 } 
 $CheckByte += $Re; 
 $Flag ++; 
 } 

 $CheckByte %= 10; 
 if (0 !== $CheckByte) { 
 $CheckByte = 10 - $CheckByte; 
 if (1 === ($Flag % 2) ) { 
 if (1 === ($CheckByte % 2)) { 
 $CheckByte += 9; 
 } 
 $CheckByte >>= 1; 
 } 
 } 

 return '7'.$CheckByte.$HashStr; 
} 

function getch($url) { return CheckHash(HashURL($url)); } 

function getpr($url) { 
 global $googlehost,$googleua; 
 $ch = getch($url); 
 $fp = fsockopen($googlehost, 80, $errno, $errstr, 30); 
 if ($fp)
 { 
 $out = "GET /tbr?features=Rank&sourceid=navclient-ff&client=navclient-auto-ff&ch=$ch&q=info:$url HTTP/1.1\r\n"; 
 $out .= "User-Agent: $googleua\r\n"; 
 $out .= "Host: $googlehost\r\n"; 
 $out .= "Connection: Close\r\n\r\n"; 

 fwrite($fp, $out); 
 while (!feof($fp))
 {
 $data = fgets($fp, 128); 
 $pos = strpos($data, "Rank_"); 
 if($pos === false)
 {}
 else
 { 
 $gpr=substr($data, $pos + 9); 
 $gpr=trim($gpr); 
 $gpr=str_replace("\n",'',$gpr); 
 if (isset($gpr)) $pr=$gpr;
 } 
 }
 if (!isset($pr)) $pr="0";
 return $pr;
 fclose($fp); 
 } 
}


$prs=getpr($url);

if($pars2!="0" AND $update7[0]==0)
{
$query8=mysql_query("UPDATE `pars` SET `pr`='$prs',`cu`='$saw',`yahoo`='0',`lipok`='$w_hit',`lipos`='$w_vis' WHERE `uid`='$row[0]'");
$query6=mysql_query("UPDATE `tables` SET `update`='1' WHERE `id`='$row[0]'");
}
if($pars2=="0")
{
$insert7=mysql_query("INSERT INTO `pars` VALUES (NULL,'$row[0]','$prs','$saw','0','$w_hit','$w_vis')");
}


}

$pars1=mysql_fetch_array(mysql_query("SELECT `pr`,`cu`,`yahoo`,`lipok`,`lipos` FROM `pars` WHERE `uid`='$row[0]'"));

				if($get_array['id']!=="")echo("<div style='visible: none;'></div>");
				echo("<div style='display:none'><input type='radio' name='sid' value='".$row[0]."'"); if($get_array['id']==$row[0]) echo("CHECKED"); echo("></div>");	

$url1=str_replace("http://","",$row[1]);
$url2=str_replace("www.", "", $url1); 
$url= str_replace("/","",$url2);	

echo("<title>Покупка ссылки $url. ".$params_array[0]."</title><h1>Покупка ссылки</h1>
                <div id='adr'> Адрес: <a href='$row[1]' target='_blank'>$row[1]</a></div>");
if($row[11]!="")
{
echo("<div id='adr'>$row[11]</div>");
}

                echo("<p>Цена покупки: <b>".$row[2]." р.</b>  + ".$config[sys]."% комиссия. В витрине отображается только ".$row[3]." последних добавленных ссылок.</p>");
				
                                                        $count_arr1=mysql_fetch_array(mysql_query("SELECT `maxtext` FROM `tables` WHERE `id`='".$row[0]."'"));
				if($get_array['id']!=="")echo("");

			echo("
<br>
<table><tr><td>URL ссылки</td><td>&nbsp;<input type='text' name='url' value='http://' autofocus /></td></tr>
<tr><td><br>Текст ссылки<a title='Текст с ненормативной лексикой модерируется.' alt='Текст с ненормативной лексикой модерируется.'>*</a></td><td><br>&nbsp;<input type='text' name='text' value='' maxlength='".$count_arr1[0]."'> (".$count_arr1[0]." символа)</td></tr>");

if($row[5]!=0) 
{
echo("<tr><td colspan='2'><br>Выделить ссылку (жирным + цвет <select name='cvet'>");
if($row[6]==1) echo("<option value='1'>Красный</option>");
if($row[7]==1) echo("<option value='2'>Зеленый</option>");
if($row[8]==1) echo("<option value='3'>Синий</option>");
if($row[9]==1) echo("<option value='4'>Оранжевый</option>");
if($row[10]!="") echo("<option value='".$row[10]."'>Другой</option>");
echo("</select> ) <b>+".$row[5]." р.</b>&nbsp;<input name='dopol' value='".$row[5]."' type='checkbox' /></td></tr>");
}

echo("<tr><td><br>"); 
// if($user_arr[0]==1) { }



echo("<tr><td><br><input type='submit' value='Купить'></td><td><br><img src='/template/apimages/warn.png' width='16' height='16' align='absmiddle'>Размещая рекламу, вы соглашаетесь с <a href='/pravila.html' target='_blank'>условиями размещения рекламы</a>!</td></tr></table>
		</form>
                
<p></p>
            </div><!-- #content-->
		</div><!-- #container-->

		<div class='sidebar' id='sideRight'>
			<div class='lf1'>
            	<div class='lf2'>
                	<div class='lf3'>
              <img class='lim' width='200' height='150' src='http://mini.s-shot.ru/1280x1024/400/jpeg/?".$row[1]."' alt='Скриншот сайта ".$row[1]."' />      	

");

}

                        echo("
                        <div id='stat'>
                        	<div class='stat'>

                        	<ul>
                                   <li class='stat3'><span class='sll'><b>Yandex ТИЦ</b></span><span class='slr'><b>$pars1[1]</b></span></li>
                                   <li class='stat4'><span class='sll'><b>Google PR</b></span><span class='slr'><b>$pars1[0]/10</b></span></li>
                                   <li class='stat7'><span class='sll'><b>Показов</b></span><span class='slr'><b>$pars1[3]</b></span></li>
                                   <li class='stat8'><span class='sll'><b>Посетителей</b></span><span class='slr'><b>$pars1[4]</b></span></li>
                            </ul><div class='clr'></div>

                            </div><!--.stat-->
                        </div><!--#stat--><br><center><div class='cod_ban_8564'></div></center>
					</div><!--.lf3-->
                </div><!--.lf2-->
            </div><!--.lf1-->");
	}
?>