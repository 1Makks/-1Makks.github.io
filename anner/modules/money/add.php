<?php
error_reporting(E_ALL);if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");

echo("<title>Выплаты : ".$params_array[0]."</title>");

if(auth===FALSE)
{
	msg("Для доступа к данной странице необходима авторизация или <a href='/registration.html'>регистрация</a>!","warning");
}
else
{
	if(count($post_array)!=0)
	{
$cena=(round($post_array['summa']+(($post_array['summa']/100)*$config['sys']),2));
$m_orderid = mt_rand(1,99999);
echo("Выберите способ оплаты:<br><br></form>");


	


// Webmoney ---->
$webmoney = $config['webmoney']; 
if($webmoney)
{
echo("
            <form method='POST' action='https://merchant.webmoney.ru/lmi/payment.asp'>
            <input type='hidden' name='LMI_PAYMENT_NO' value='".$m_orderid."'>
            <input type='hidden' name='LMI_PAYMENT_AMOUNT' value='".$cena."'>
            <input type='hidden' name='LMI_PAYMENT_DESC' value='Пополнение баланса пользователю ".$user_arr[1]." на сумму ".$cena." рублей.'>
            <input type='hidden' name='LMI_PAYEE_PURSE' value='".$config['wmr']."'>
            <input type='hidden' name='user' value='".$user_arr[0]."'>
            <input type='hidden' name='type' value='5'>
            <input type=image src='/template/webmoney.png'>
            </form>");
} else {
echo "";
}
            
			
// <----- Webmoney



// Payeer---->
$desc = base64_encode('0|||0|||0|||0|||0|||5|||'.$user_arr[0].'|||0');
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


  
// Robokassa  ------>
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
$crc  = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1");
$crc  = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1:Shp_item=$shp_item:Shp_item2=$shp_item2:Shp_item3=$shp_item3:Shp_item4=$shp_item4:Shp_item5=$shp_item5:Shp_item6=$shp_item6");
//$crc  = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1:Shp_item=$shp_item:Shp_item2=$shp_item2:Shp_item3=$shp_item3:t=1");

// форма оплаты товара
// payment form

$robokassa = $config['robokassa']; 
if($robokassa)
{
echo("<form action='http://merchant.roboxchange.com/Index.aspx' method=POST>
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


// Яндекс деньги  ------>
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
$crc  = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1");
$crc  = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1:Shp_item=$shp_item:Shp_item2=$shp_item2:Shp_item3=$shp_item3:Shp_item4=$shp_item4:Shp_item5=$shp_item5:Shp_item6=$shp_item6");
//$crc  = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1:Shp_item=$shp_item:Shp_item2=$shp_item2:Shp_item3=$shp_item3:t=1");

// форма оплаты товара
// payment form

$robokassa = $config['yandex']; 
if($robokassa)
{
echo("<form action='http://merchant.roboxchange.com/Index.aspx' method=POST>
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
// <----- Яндекс деньги


// QIWI  ------>
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
$crc  = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1");
$crc  = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1:Shp_item=$shp_item:Shp_item2=$shp_item2:Shp_item3=$shp_item3:Shp_item4=$shp_item4:Shp_item5=$shp_item5:Shp_item6=$shp_item6");
//$crc  = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1:Shp_item=$shp_item:Shp_item2=$shp_item2:Shp_item3=$shp_item3:t=1");

// форма оплаты товара
// payment form

$robokassa = $config['qiwi']; 
if($robokassa)
{
echo("<form action='http://merchant.roboxchange.com/Index.aspx' method=POST>
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

	}
}
?>