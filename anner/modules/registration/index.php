<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");

echo("<title>Регистрация : ".$params_array[0]."</title>");

if(auth===TRUE)
{
    msg("Вы уже зарегистрированы!","warning");
}
else
{

if(count($post_array)!=0)
{
        if($post_array['login']=="" OR $post_array['email']=="" OR $post_array['passw']=="" OR $post_array['passw_a']=="")
        {
                $err="Заполните все обязательные поля";
        }
        elseif(!preg_match("/^([a-zA-Z0-9\_\-]{2,50})$/",$post_array['login']) OR strlen($post_array['login'])<2 OR strlen($post_array['login'])>50)
        {
                $err="Некорректно введен логин";
        }
        elseif(!preg_match("/^[a-zA-Z0-9_.-]{1,20}@(([a-zA-Z0-9-]+\.)+([a-z]{2,3})|[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3})$/",$post_array['email']) OR strlen($post_array['email'])<7 OR strlen($post_array['email'])>50)
        {
                $err="Некорректно введен email адрес";
        }
        elseif(strlen($post_array['passw'])<6)
        {
                $err="Длинна пароля должна быть больше 6-ти символов";
        }
        elseif($post_array['passw']!=$post_array['passw_a'])
        {
                $err="Пароли не совпадают";
        }
        elseif(strlen($post_array['passw'])>30)
        {
                $err="Длинна пароля не должна быть больше 30-ти символов";
        }
        elseif($post_array['icq']!="" AND strlen($post_array['icq'])>15)
        {
                $err="Некорреткно введен ICQ номерок";
        }
        elseif($post_array['wmr']!="" AND strlen($post_array['wmr'])!=13)
        { 
                if(!preg_match("/^R([0-9]{12})$/",$post_array['wmr']))
                $err="Некорреткно введен R кошелек";
        }
        elseif(!isset($post_array['agreerules']))
        {
                $err="Вы должны согласится с правилами системы";
        }
        $query_array=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM `users` WHERE `login`='".$post_array['login']."'"));
        if($query_array[0]>0)
        {
                $err="Пользователь с таким логином уже есть на сайте";
        }
        $query_array=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM `users` WHERE `email`='".$post_array['email']."'"));
        if($query_array[0]>0)
        {
                $err="Пользоваель с таким email уже есть на сайте";
        }
    
    if(!empty($post_array['wmr'])){
    $query_array=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM `users` WHERE `wmr`='".$post_array['wmr']."'"));
        if($query_array[0]>0 AND $post_array['wmr']!="")
        {
                $err="Пользователь с таким R кошельком уже зарегистрирован!";
        }
        }else
         $post_array['wmr']='';
        
        
        $query_array=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM `users` WHERE `icq`='".$post_array['icq']."'"));
        if($query_array[0]>0 AND $post_array['icq']!="")
        {
                $err="Пользователь с таким icq номером уже зарегистрирован!";
        }
        $query_array=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM `users` WHERE `id`='".intval($cookie_array['ref'])."'"));
        if($query_array[0]=0 AND intval($cookie_array['ref'])!=0)
        {
                $err="Реферал не найден!";
        }
        if($err!="")
        {
                msg($err,"warning");
        }
        else
        {
                $insert_query=mysql_query("INSERT INTO `users` VALUES 
                    (NULL,'".$post_array['login']."','".md5($post_array['passw'])."','".$post_array['email']."','1','0','".intval($cookie_array['ref'])."','0','".intval($post_array['icq'])."','".$post_array['wmr']."','".$ip."','0','0','0','".date("d.m.Y H:i")."','0','0', '')
                ");
                /*
                //Письмо пользователю
                $subject="Регистрация";
                $headers="From: ".$config['admin_mail']."\n";
                $headers.="Reply-to: ".$config['admin_mail']."\n";
                $headers.="X-Sender: < ".$config['admin_mail']." >\n";
                $headers.="Content-Type: text/html; charset=utf-8\n";
                $text=$lang['reg_mail'];
                mail($email, $subject, $text, $headers);
                */
                if($insert_query) echo header ("location: /good.html","succes"); else msg("location: /warning.html","warning");
        }
}
echo("
<h2>Регистрация</h2>
<br>
Пройдите несложную регистрацию для начала работы с нашей системой.
<br><br>
<form name='form' action='registration.html' method='POST'>
        <table>
                <tr>
                        <td>Логин <font color='red'>*</font></td><td>&nbsp;&nbsp;<input type='text' name='login' value='".$post_array['login']."'></td>
                </tr>
                <tr>
                        <td><br />Email <font color='red'>*</font></td><td><br />&nbsp;&nbsp;<input type='text' name='email' value='".$post_array['email']."'></td>
                </tr>
                <tr>
                        <td><br />Пароль <font color='red'>*</font></td><td><br />&nbsp;&nbsp;<input type='password' name='passw' value='".$post_array['passw']."'></td>
                </tr>
                <tr>
                        <td><br />Повторите <font color='red'>*</font></td><td><br />&nbsp;&nbsp;<input type='password' name='passw_a' value='".$post_array['passw_a']."'></td>
                </tr>
                <tr>
                        <td><br />WMR</td><td><br />&nbsp;&nbsp;<input type='text' name='wmr' value='".$post_array['wmr']."'></td>
                </tr>
                <tr>
                        <td><br />ICQ</td><td><br />&nbsp;&nbsp;<input type='text' name='icq' value='".$post_array['icq']."'></td>
                </tr>
                <tr>
                </tr>
				Поля помеченные <font color='red'>*</font> обязательны к заполнению!<br/><br/>
                <tr>
                        <td colspan='2'><br /><img src='/template/apimages/warn.png' width='16' height='16' align='absmiddle'><input type='checkbox' name='agreerules'> Согласен(-а) с <a href='/support.html&sub=terms' target='_blank'>правилами</a><br />
       
                       <br /><input type='submit' value='Регистрация'></td>
                </tr>
        </table>
</form>");
}
?>