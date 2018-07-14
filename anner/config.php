<?php
define("SOURCE_DIR","source");	// Папка ядра
define("LANG_DIR","langs");		// Папка с языками
define("MOD_DIR","modules");	// Папка модулей
define("AP",true);				// Не менять
$config['admin']="admin"; // Не менять, если не знаете за что отвечает этот параметр!
$config['sub']="TRUE";
$config['admin_mail']="cool.melkij@yandex.ru"; // Email даминистратора сайта (с него будут проводится рассылки)
$config['s_title']="opcat.ru — Сервис витрин ссылок и баннеров"; // Заголовок (TITLE) сайта
$config['s_url']="http://opcat.ru/"; // Адрес сайта
$config['wmid']="372825632058"; // Ваш WMID в системе вебмани.
$config['skype']="Ваш скайп"; // Ваш скайп.
$params_array[0]=$config['s_title'];
$config['refp']="15"; // Реферальный процент системы.
$config['minsumm']="10"; // Минимальная сумма на вывод.
$config['sys']="2"; // Комиссия системы.
$config['news']='';

// Настройка платёжной системы WebMoney
$config['webmoney']= true; // Для включения платёжной системы WebMoney поставить значение true , для выключения false.
$config['wmr']="R314294226427"; // Номер вашего wmr кошелька.
$config['secret_key']="fw4t34g35DE"; // Секретный ключ.

// Настройка платёжной системы Payeer
$config['payeer']= false; // Для включения платёжной системы Payeer поставить значение true , для выключения false.
$config['m_shop']="37598849"; // Номер вашего магазина.
$config['m_key']="ERK5t805"; // Секретный ключ (Не путать с Master Key!).

// Настройка платёжной системы RoboKassa
$config['robokassa']= true; // Для включения платёжной системы RoboKassa поставить значение true , для выключения false.
$config['mrh_login']="WMR-SHOP.RU"; // Логин.	
$config['mrh_pass1']="We"; // Пароль #1.
$config['mrh_pass2']="VqJ7V"; // Пароль #2.
		
		$config['yandex']= false;
		$config['qiwi']= false;
		
		
		// Чтобы отключить не нужны вам системы пополнения измените true на false
	
		

?>
