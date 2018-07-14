<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен");

// База данных //////////////////////////////////////////////////////////////
$connect=@mysql_connect($config['database_host'],$config['database_user'],$config['database_passw']);
if(!$connect) exit("Нет подключения к серверу MySQL");
else
{
        $database=@mysql_select_db($config['database_name'],$connect);
        if(!$database) exit("Нет подключения к базе данных");
}
mysql_query("SET NAMES utf8");
?>