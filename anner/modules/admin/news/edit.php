<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");

$query_array=mysql_fetch_array(mysql_query("SELECT `id`,`descr`,`content` FROM `news` WHERE `id`='".intval($get_array['id'])."'"));
if($query_array[0]=="") 
{ 
msg("Новость с таким ID не найдена!","warning"); 
} 
else 
{
if(isset($post_array['post'])) { if($post_array['title']=="" OR $post_array['text']=="")

{
msg("Заполните все поля!","warning"); 
} 
else 
{ 
$upgrade=mysql_query("UPDATE `news` SET `descr`='".$post_array['title']."',`content`='".$post_array['text']."' WHERE `id`='".$query_array[0]."'");
if($upgrade) header("location: /".$config['admin'].".php?page=news"); else msg("Невозможно занести данные в базу данных!","warning");
} 
}
echo("<form action='/".$config['admin'].".php?page=news&sub=edit&id=$query_array[0]' method='POST'>
<table><tr>
 <td>Заголовок</td><td><input type='text' class='ap_input' name='title' value='".$query_array[1]."' /></td>
 </tr> <tr> <td colspan='2'><textarea cols='80' rows='15' name='text' class='ap_textarea'>$query_array[2]</textarea></td>
 </tr> <tr> <td colspan='2'><input type='submit' class='ap_button' name='post' value='Отправить' /></td>
 </tr> </table> </form> "); } ?> 