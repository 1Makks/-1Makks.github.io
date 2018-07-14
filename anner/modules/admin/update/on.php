<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");


			$query=mysql_query("UPDATE `tables` SET `update`='0'");
			if($query) header("location: /".$config['admin'].".php?page=update"); else msg("Ошибка при изменении!","warning");

?>