<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");


			$query=mysql_query("UPDATE `tables` SET `update`='0' WHERE `id`='".$get_array['id']."'");
			if($query) header("location: /".$config['admin'].".php?page=users"); else msg("Ошибка при изменении!","warning");

?>