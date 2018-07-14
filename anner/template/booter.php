<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
              <meta http-equiv="content-type" content="text/html; charset=windows-1251" />
              <link rel="icon" href="/favicon.ico" type="image/x-icon" />
			  <link rel="stylesheet" href="/css/style.css" type="text/css" media="screen, projection" />
              <link type="text/css" rel="StyleSheet" href="/template/apstyle.css" />
              <script type="text/javascript" src="https://apis.google.com/js/plusone.js">
              {lang: 'ru'}
              </script>
</head>

<body>

<div id="wrapper">

	<div id="header">
    	<div id="lh">
		<a href="/"> <img id="logo" src="/images/logo.png" alt="" /> </a>
		<span id="htxt">Служба поддержки:<br />

<a id="mail"><?php echo ($config['admin_mail']); ?></a>
</span>
		<span id="rh"><script language='JavaScript' charset='utf-8' src='<?php echo($config['s_url']); ?>/codes/banner.php?id=2&s=1'></script>
</span>
		</div>
       
    
        <div id="menu">
        	<ul class="menu">
            	<li class="first"><a href="/">Главная</a></li>
                <li><a href="/links.html">Рекламодателям</a></li>
                <li><a href="/news.html">Новости</a></li>
			
				<li><a href="/faq.html">Вопросы</a></li>
				
                <li class="last"><a href="/support.html">Контакты</a></li>
                
            </ul>
        </div>
    </div><!-- #header-->

	<div id="middle">

		<div id="container">
			<div id="content">
<?php 
if($baned!="") 
{
msg("$baned","warning");
}
$omgr=0;
?>