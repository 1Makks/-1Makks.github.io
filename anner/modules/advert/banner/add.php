<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");

$omgr=1;

	if(count($post_array)!=0)
	{
		if($post_array['url']=="http://" OR $post_array['url']=="")
		{
			$err="Введите URL";
		}
		if($post_array['ban_href']=="http://" OR $post_array['ban_href']=="")
		{
			$err="Введите URL баннера";
		}
                   $htt=substr($post_array['url'],0,7);

		if($htt!="http://")
		{
			$err="Ошибка URL адрес без http://";
		}
                   $http=substr($post_array['ban_href'],0,7);

		if($http!="http://")
		{
			$err="Ошибка URL баннера без http://";
		}
		if(strlen($post_array['url'])>200)
		{
			$err="Длинна поля URL больше максимально допустимого (200 символов максимум)";
		}
		if(strlen($post_array['ban_href'])>200)
		{
			$err="Длинна поля Баннер больше максимально допустимого (200 символов максимум)";
		}
		if(intval($post_array['t']<"1"))
		{
			$err="Некорректный размер баннера";
		}
		if($post_array['sid']=="")
		{
			$err="Не выбран сайт";
		}
		$count_arr=mysql_fetch_array(mysql_query("SELECT `id`,`linknum`,`price`,`uid`,`url` FROM `tables` WHERE `id`=".mysql_real_escape_string(intval($post_array['sid'])).""));
		$_SESSION['price']=$count_arr[2];
		if($count_arr[0]=="")
		{
			$err="Нет такого сайта";
		}
		
		if(intval($post_array['week'])>4 OR intval($post_array['week'])<1)
		{
			$err="Некорректно введены недели";
		}
		if($err=="")
		{
			$m=date("m");
			$d=date("d")+7*intval($post_array['week']);
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
			elseif($d>31 AND ($m==1 OR $m==3 OR $m==5 OR $m==7 OR $m==8 OR $m==10 OR $m==12))
			{
				$m++;
				$d=$d-31;
			}

$cena=($count_arr[2]*intval($post_array['week']))+($count_arr[2]*intval($post_array['week'])*0.05);
$cenas=($count_arr[2]*intval($post_array['week']));
$m_orderid = mt_rand(1,99999);
$post_array['url']=str_replace("http://http://","http://",$post_array['url']);
$post_array['ban_href']=str_replace("http://http://","http://",$post_array['ban_href']);

			echo("<br>
Убедитесь в правильности набора данных. После оплаты редактирование баннера будет невозможным!<br><br>
                                          <table><tr><td>URL:</td><td>&nbsp;&nbsp;&nbsp;".htmlspecialchars($post_array['url'])."</td><td rowspan='5'>&nbsp;&nbsp;<a href='".htmlspecialchars($post_array['url'])."' target='_blank'></td></tr>
                                           <tr><td><br>Баннер:</td><td><br>&nbsp;&nbsp;&nbsp;".htmlspecialchars($post_array['ban_href'])."</td></tr>
                                           <tr><td><br>Время:</td><td><br>&nbsp;&nbsp;&nbsp;".$post_array['week']." неделя(и)
                                           <tr><td><br>Сумма:</td><td><br>&nbsp;&nbsp;&nbsp;".$cena." руб. с учетом комиссии
                                           <tr><td colspan='2'><br><center><a href='/advert.html&sub=banner&undersub=add&id=".$post_array['sid']."'>Изменить</a></center></td></tr></table>

            <br><br>Выберите способ оплаты:<br><br>");
echo("<form action='advert.html&sub=banner&undersub=bal' method='POST'>
	             <input type='hidden' name='summa' value='$cenas'>
	             <input type='hidden' name='pod' value='1'>
                           <input type='hidden' name='id' value='$user_arr[0]'>
                           <input type='hidden' name='uid' value='".$count_arr[3]."'>
	             <input type='hidden' name='lid' value='".$count_arr[0]."'>
	             <input type='hidden' name='week' value='".htmlspecialchars($post_array['week'])."'>
	             <input type='hidden' name='sid' value='".urlencode(htmlspecialchars($post_array['url']))."'>
	             <input type='hidden' name='txt' value='".urlencode(htmlspecialchars($post_array['ban_href']))."'>
                           <input type=image src='/template/balance.png'> - <i>без комиссии</i>
	</form>");
	
	




// Webmoney ---->
$webmoney = $config['webmoney']; 
if($webmoney)
{
echo("<form method='POST' action='https://merchant.webmoney.ru/lmi/payment.asp'>
            <input type='hidden' name='LMI_PAYMENT_NO' value='".$m_orderid."'>
            <input type='hidden' name='LMI_PAYMENT_AMOUNT' value='".$cena."'>
            <input type='hidden' name='LMI_PAYMENT_DESC' value='Оплата ".htmlspecialchars($post_array['url'])." ".htmlspecialchars($post_array['ban_href']).", ".$count_arr[4]." id ".$count_arr[0]."'>
            <input type='hidden' name='LMI_PAYEE_PURSE' value='".$config['wmr']."'>
			<input type='hidden' name='uid' value='".$count_arr[3]."'>
			<input type='hidden' name='lid' value='".$count_arr[0]."'>
			<input type='hidden' name='sid' value='".urlencode(htmlspecialchars($post_array['url']))."'>
			<input type='hidden' name='txt' value='".urlencode(htmlspecialchars($post_array['ban_href']))."'>
			<input type='hidden' name='week' value='".htmlspecialchars($post_array['week'])."'>
			<input type='hidden' name='type' value='1'>
            <input type=image src='/template/webmoney.png'> 
            </form>");
} else {
echo "";
}		
// <-----  Webmoney 


	
// Payeer---->		
$desc = base64_encode($count_arr[3].'|||'.$count_arr[0].'|||'.urlencode(htmlspecialchars($post_array['url'])).'|||'.urlencode(htmlspecialchars($post_array['ban_href'])).'|||'.$post_array['week'].'|||1|||0|||0');
$m_shop = $config['m_shop'];
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
			


// Robokassa ---->  
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



//  Яндекс Деньги ---->  
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


//  QIWI ---->  
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
		echo("
		<form action='' method='POST'>
			");

			if($get_array['id']!=="0") $o=" AND`id`='".intval($get_array['id'])."'";   //Вставил 0 вместо пусто ""
			$site_arr=mysql_query("SELECT `id`,`url`,`price`,`atext` FROM `tables` WHERE `status`=2 AND `t`=2 ".$o."");
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
     
    for ($i = $length - 1;  $i >= 0;  $i --) { 
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





				$count_arr1=mysql_fetch_array(mysql_query("SELECT `w`,`d` FROM `tables` WHERE `id`='".$row[0]."'"));
				echo("<div style='display:none'><input type='radio' name='sid' value='".$row[0]."'"); if($get_array['id']==$row[0]) echo("CHECKED"); echo("></div>");

			
$url1=str_replace("http://","",$row[1]);
$url2=str_replace("www.", "", $url1); 
$url= str_replace("/","",$url2);	

echo("<title>Покупка баннера $url. ".$params_array[0]."</title><h1>Покупка баннера</h1>
               <div id='adr'> Адрес: <a href='$row[1]' target='_blank'>$row[1]</a></div>");
if($row[3]!="")
{
echo("<div id='adr'>$row[3]</div>");
}
$limm=mysql_fetch_array(mysql_query("SELECT `lastdate`,`holdv`,`slot` FROM `tables` WHERE `id`='".intval($get_array['id'])."'"));
if($limm[2]!=2)
{

if($limm[1]==1)
{

echo("<div id='adr'>Рекламное место занято до $limm[0], однако вы можете занять очередь:
<br /><br />
1. Заполните форму.<br />
2. Оплатите размещение рекламы.<br />
3. И уже $limm[0] ваш баннер займет рекламный блок.<br /><br /></div>");


                echo("<p>Цена покупки: <b><span id='summa'>".$row[2]."</span> руб.</b> + ".$config['sys']."% комиссия (за неделю)</p>");


			echo("
<br>
<table>
				<tr>
					<td>URL ссылки</td><td>&nbsp;<input type='text' name='url' value='http://' autofocus /></td>
				</tr>
				<tr>
					<td><br>URL картинки</td><td><br>&nbsp;<input type='text' name='ban_href' value='http://'> (".$count_arr1[0]."x".$count_arr1[1]." ,jpg, png, gif)
	</td>
				</tr>
				<tr>
					<td colspan='2'><div style='display: none;'><input type='radio' name='t' value='1' checked='1'></div></td>
				</tr>
				<tr>
					<td><br>Время</td><td><br>&nbsp;

					<select name='week' onchange=$('#summa').html($row[2]*(this.value*1))>
						<option value='1'>1 неделя</option>
						<option value='2'>2 недели</option>
						<option value='3'>3 недели</option>
						<option value='4'>4 недели</option>
					</select>

					</td>
				</tr>
				
				
				
				
				
				<tr><td><br><input type='submit' value='Купить'></td><td><br><img src='/template/apimages/warn.png' width='16' height='16' align='absmiddle'> Размещая рекламу, вы соглашаетесь с <a href='/pravila.html' target='_blank'>условиями размещения рекламы</a>!</td></tr>
			</table>

		</form>                

<p></p>
            <!-- #content-->");
}

else
{
echo("<div id='adr'>Рекламное место занято</div>");
}
}


else
{


///////////////////// report код
//echo '<pre>';
//print_r($limm);
//echo '</pre>';

//echo '<pre>';
//print_r($get_array['id']);
//echo '</pre>';

$time_new = date( 'j.m.Y G:i',time());
$restors = mysql_query("select 
								* 
						from abanner 
						where (`sid`='".$get_array['id']."' AND `status`=2 AND `lim` > '".$time_new."') LIMIT ".$limm[2]." ");
												
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
if($count_masInfo>=$limm[2]){
	$text_imfo = 0;
}else{
	$text_imfo = $limm[2] - $count_masInfo;
}
			if($text_imfo!=0)

echo("<p>Цена покупки: <b><span id='summa'>".$row[2]."</span> руб.</b> + ".$config['sys']."% комиссия (за неделю)</p>
<br>
<table>
				<tr>
					<td>URL ссылки</td><td>&nbsp;<input type='text' name='url' value='http://' autofocus /></td>
				</tr>
				<tr>
					<td><br>URL картинки</td><td><br>&nbsp;<input type='text' name='ban_href' value='http://'> (".$count_arr1[0]."x".$count_arr1[1].", jpg, png, gif)</td>
				</tr>
				<tr>
					<td colspan='2'><div style='display: none;'><input type='radio' name='t' value='1' checked='1'></div></td>
				</tr>
				<tr>
					<td><br>Время</td><td><br>&nbsp;

					<select name='week' onchange=$('#summa').html($row[2]*(this.value*1))>
						<option value='1'>1 неделя</option>
						<option value='2'>2 недели</option>
						<option value='3'>3 недели</option>
						<option value='4'>4 недели</option>
					</select>

					</td>
				</tr>
				<tr><td><br><input type='submit' value='Купить'></td><td><br><img src='/template/apimages/warn.png' width='16' height='16' align='absmiddle'>Размещая рекламу, вы соглашаетесь с <a href='/pravila.html' target='_blank'>условиями размещения рекламы</a>!</td></tr>
			</table>

		</form>                

<p></p>
            <!-- #content-->");
}

echo("	</div>	</div><!-- #container-->

		<div class='sidebar' id='sideRight'>
			<div class='lf1'>
            	<div class='lf2'>
                	<div class='lf3'>
                    	<img class='lim' width='200' height='150' src='http://mini.s-shot.ru/1280x1024/400/jpeg/?".$row[1]."' alt='Скриншот сайта ".$row[1]."' />

");

}

                        echo("<div id='stat'>
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