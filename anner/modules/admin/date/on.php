<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");



$query_array=mysql_query("SELECT `sid`,`lim` FROM `abanner`"); 
 
if(mysql_num_rows($query_array)=="0") 
{ 
echo("Ошибка!"); 
} 
while($row=mysql_fetch_array($query_array)) 
{ 


			$query=mysql_query("UPDATE `tables` SET `lastdate`='".$row[1]."' WHERE `id`='".$row[0]."'");
} 
			header("location: /".$config['admin'].".php");

?>