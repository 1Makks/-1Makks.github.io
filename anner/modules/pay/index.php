<?php

if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");

// Вывод title
echo("<title>Ошибка при покупке! : ".$params_array[0]."</title>");

echo("


<br><center><h3><img src='/template/apimages/delete.png'> Платёжная система недоступна!</h3></center>

<br><br>");
?>