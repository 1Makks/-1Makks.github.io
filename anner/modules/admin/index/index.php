<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");


$rr=date("d.m.Y H:i");

echo("<font size='4'>Время на сервера $rr</font>");

echo("
<table>
<tr><td><br><a href='".$config['admin'].".php?page=search_user'><img src='/template/admin/search_user.png' width='64' height='64' title='Поиск пользователей'></a></td><td><font size='6'><a href='".$config['admin'].".php?page=search_user'>Поиск пользователей</a></font></td></tr>
<tr><td><br><a href='".$config['admin'].".php?page=search_sites'><img src='/template/admin/search_sites.png' width='64' height='64' title='Поиск площадок'></a></td><td><font size='6'><a href='".$config['admin'].".php?page=search_sites'>Поиск площадок</a></font></td></tr>
<tr><td><br><a href='".$config['admin'].".php?page=sites'><img src='/template/admin/sites.png' title='Сайты'></a></td><td><font size='6'><a href='".$config['admin'].".php?page=sites'>Сайты</a></font></td></tr>
<tr><td><br><a href='".$config['admin'].".php?page=advlink'><img src='/template/admin/link.png' title='Ссылки'></a></td><td><font size='6'><a href='".$config['admin'].".php?page=advlink'>Ссылки</a></font></td></tr>
<tr><td><br><a href='".$config['admin'].".php?page=advban'><img src='/template/admin/banner.png' title='Баннеры'></a></td><td><font size='6'><a href='".$config['admin'].".php?page=advban'>Баннеры</a></font></td></tr>
<tr><td><br><a href='".$config['admin'].".php?page=news'><img src='/template/admin/news.png' title='Новости'></a></td><td><font size='6'><a href='".$config['admin'].".php?page=news'>Новости</a></font></td></tr>
<tr><td><br><a href='".$config['admin'].".php?page=tickets'><img src='/template/admin/tickets.png' title='Тикеты'></a></td><td><font size='6'><a href='".$config['admin'].".php?page=tickets'>Тикеты</a></font></td></tr>
<tr><td><br><a href='".$config['admin'].".php?page=balance'><img src='/template/admin/money.png' title='Баланс'></a></td><td><font size='6'><a href='".$config['admin'].".php?page=balance'>Баланс</a></font></td></tr>
<tr><td><br><a href='".$config['admin'].".php?page=users'><img src='/template/admin/users.png' title='Пользователи'></a></td><td><font size='6'><a href='".$config['admin'].".php?page=users'>Пользователи</a></font></td></tr>
<tr><td><br><a href='".$config['admin'].".php?page=links'><img src='/template/admin/icon_pages.png' title='Рекламодателям(ссылки)'></a></td><td><font size='6'><a href='".$config['admin'].".php?page=links'>Рекламодателям(ссылки)</a></font></td></tr>
<tr><td><br><a href='".$config['admin'].".php?page=banners'><img src='/template/admin/icon_pages.png' title='Рекламодателям(баннеры)'></a></td><td><font size='6'><a href='".$config['admin'].".php?page=banners'>Рекламодателям(баннеры)</a></font></td></tr>
<tr><td><br><a href='".$config['admin'].".php?page=update'><img src='/template/admin/step1.png' title='Управление статистикой'></a></td><td><font size='6'><a href='".$config['admin'].".php?page=update'>Управление статистикой</a></font></td></tr>
<tr><td><br><a href='".$config['admin'].".php?page=money'><img src='/template/admin/step1.png' title='Пополнение баланса'></a></td><td><font size='6'><a href='".$config['admin'].".php?page=money'>Пополнение баланса</a></font></td></tr>
</table>
");

?>