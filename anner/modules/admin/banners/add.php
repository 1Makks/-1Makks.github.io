<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");

if(isset($post_array['uid'])) 
{ 
if($post_array['uid']=="" AND $post_array['pos']=="")
{ 
msg("Заполните все поля!","warning"); 
} 
else 
{ 
$insert=mysql_query("INSERT INTO `banners` VALUES (NULL,'".$post_array['uid']."','".$post_array['pos']."','".$post_array['text']."')");
if($insert) header("location: /".$config['admin'].".php?page=banners"); 
else 
msg("Невозможно занести данные в базу данных!","warning");

} 
} 
echo("
<form action='/".$config['admin'].".php?page=banners&sub=add' method='POST'> 
<table> <tr> 
<td>UID</td>
<td><input type='text' class='ap_input' name='uid' /></td></tr> 
<class='ap_input' name='pos' /> 

<class='ap_input' name='text' /><tr>

<td colspan='2'><input type='submit' class='ap_button' name='post' value='Отправить' /></td>
 </tr> </table> </form> "); ?>