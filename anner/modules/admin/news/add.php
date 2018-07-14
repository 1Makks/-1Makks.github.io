<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");

if(isset($post_array['post'])) 
{ 
if($post_array['descr']=="" OR $post_array['content']=="")
{ 
msg("Заполните все поля!","warning"); 
} 
else 
{ 
$post_array['content']=ereg_replace("\"","&quote;",ereg_replace("\'","&quotel;",stripslashes($post_array['content'])));
$insert=mysql_query("INSERT INTO `news` VALUES (NULL,'".$date."','".$post_array['descr']."','".$post_array['content']."')");
if($insert) header("location: /".$config['admin'].".php?page=news"); 
else 
msg("Невозможно занести данные в базу данных!","warning");

} 
} 
echo("
<form action='/".$config['admin'].".php?page=news&sub=add' method='POST'> 
<table> <tr> 
<td>Заголовок</td>
<td><input type='text' class='ap_input' name='descr' value='".$post_array['descr']."' /></td></tr> <tr>
<td colspan='2'><textarea cols='80' rows='15' name='content' class='ap_textarea'>".$post_array['content']."</textarea></td></tr> <tr> 
<td colspan='2'><input type='submit' class='ap_button' name='post' value='Отправить' /></td>
 </tr> </table> </form> "); ?>