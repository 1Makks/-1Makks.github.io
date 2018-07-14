<?php

if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");

// Вывод title
echo("<title>Контакты: ".$params_array[0]."</title>");

echo("

<h2>Контакты</h2>
<div>
<br>
<a href='http://www.plati.ru/asp/pay.asp?id_d=1732936'>Купить скрипт онлайн</a>

<br><br><b>По всем вопросам можно обращаться</b><br><br>
<img src='/template/apimages/mail.png' width='15' height='15' align='absmiddle'>E-mail: ".$config['admin_mail']."<br>
<img src='/template/apimages/wmid.png' width='15' height='15' align='absmiddle'>WMID: ".$config['wmid']." <br>
<img src='/template/apimages/skype.png' width='15' height='15' align='absmiddle'>Skype: ".$config['skype']."<br>
<img src='/template/apimages/support.png' width='15' height='15' align='absmiddle'>Поддержка: <a href='/tickets.html'>support</a><br>
</div>

<br>
<a href='https://webmoney.ru' target='_blank'><img src='/images/webmoney2.png' alt='' border='0'></a>
<a href='https://passport.webmoney.ru/asp/certview.asp?wmid=".$config['wmid']."' target='_blank'><img src='/images/webmoney.png' alt='Здесь находится аттестат нашего WM идентификатора ".$config['wmid']."' border='0' /></a>
<br><br>
<a href='/support.html&sub=terms'>Пользовательское соглашение</a> | <a href='/support.html&sub=uved'>Уведомление об ответственности</a>

<br><br>");
?>