<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен");

$query_array=mysql_fetch_array(mysql_query("SELECT `id`,`href`,`pos` FROM `links` WHERE `id`='".$get_array['id']."'"));
if($query_array[0]=="") 
{ 
msg("Объявление с таким ID нет","warning"); 
} 
else 
{

if(count($post_array)>0)
	{

$upgrade=mysql_query("UPDATE `links` SET `href`='".$post_array['href']."',`pos`='".$post_array['pos']."' WHERE `id`='".$get_array['id']."'");
if($upgrade) header("location: /".$config['admin'].".php?page=links"); else msg("Невозможно занести данные в базу данных","warning");

}
echo("<form action='/".$config['admin'].".php?page=links&sub=pos&id=".$get_array['id']."' method='POST'>ID площадки <input type='text' name='href' value='".$query_array[1]."'><br />
		
		<input type='submit' value='Править'></form> "); 
 
}
?> 