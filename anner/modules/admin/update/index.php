<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");
echo("<a href='/".$config['admin'].".php?page=update&sub=on'>Запустить обновление статистики</a>
<br><br><a href='/".$config['admin'].".php?page=update&sub=off'>Отключить обновление статистики</a>");
?>