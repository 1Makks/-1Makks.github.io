<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");



$query_array=mysql_query("SELECT `uid`,`lipos` FROM `pars`"); 
 
if(mysql_num_rows($query_array)=="0") 
{ 
echo("Ошибка!"); 
} 
while($row=mysql_fetch_array($query_array)) 
{ 


			$query=mysql_query("UPDATE `reclam` SET `pos`='".$row[1]."' WHERE `href`='".$row[0]."'");
} 
			header("location: /".$config['admin'].".php?page=links");

?>