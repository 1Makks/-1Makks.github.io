<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен");

if(isset($post_array['uid'])) 
{ 
if($post_array['uid']=="" AND $post_array['pos']=="")
{ 
msg("Заполните все поля","warning"); 
} 
else 
{ 
$insert=mysql_query("INSERT INTO `links` VALUES (NULL,'".$post_array['uid']."','".$post_array['uid']."')");
if($insert) header("location: /".$config['admin'].".php?page=links"); 
else 
msg("Невозможно занести данные в базу данных","warning");
} 
} 
echo("
<form action='/".$config['admin'].".php?page=links&sub=add' method='POST'> 
<table> <tr> 
<td>UID</td>
<td><input type='text' class='ap_input' name='uid' /></td></tr>  <tr>
<td colspan='2'><input type='submit' class='ap_button' name='post' value='Отправить' /></td>
 </tr> </table> </form> "); ?>