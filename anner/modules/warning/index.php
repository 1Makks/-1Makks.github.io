<?php

if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");

// Вывод title
echo("<title>Ошибка при записи в БД! : ".$params_array[0]."</title>");

echo("

<br><center><h3><img src='/template/apimages/delete.png'>Ошибка при записи в БД!</h3></center>

<br><br>");
?>