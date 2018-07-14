<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");

echo("<title>Восстановление пароля : ".$params_array[0]."</title>");
if(isset($post_array['post']))
{
        // Проверка заполнености полей
        if($post_array['login']=="" AND $post_array['email']=="")
        {
                msg("Введите свой логин и email","warning");
        }
        else
        {
                // Проверка логина
                if(!preg_match("/^[a-zA-Z0-9_\-]{3,30}$/",$post_array['login']) AND $post_array['login']!="")
                {
                        msg("Неправильно введен логин. Допускается A-Z,a-z,0-9, символ подчеркивания (_), тире (-)","warning");
                }
                else
                {
                        // Проверка email
                         if(!preg_match("/^[a-zA-Z0-9_-]+[a-zA-Z0-9_.-]*@[a-zA-Z0-9_-]+[a-zA-Z0-9_.-]*\.[a-z]{2,5}$/",$post_array['email']) AND $post_array['email']!="")
                        {
                                msg("Некорректно введен email","warning");
                        }
                        else
                        {
                                // Проверка капчи
                                if($post_array['captcha']!=$_SESSION['captcha'])
                                {
                                        msg("Некорректно введена капча","warning");
                                }
                                else
                                {
                                        // Проверка существования пользователя
                                        $query=mysql_fetch_array(mysql_query("SELECT `id`,`email` FROM `users` WHERE `email`='".$post_array['email']."' AND `login`='".$post_array['login']."' LIMIT 1"));
                                        if($query[0]=="")
                                        {
                                                msg("Пользователь с таким логином или email адресом не найден","warning");
                                        }
                                        else
                                        {
                                                // отправка пароля
                                                $passw=rand(9999999,9999999999);
                                                $message_e="Здравствуйте, Уважаемый Пользователь!\nКто-то запросил восстановление пароля на сайте ".mysql_real_escape_string($_SERVER['HTTP_HOST'])."\nIP-адрес запросившего пароль: $ip\n\nВаш новый пароль: $passw\n\nДата отправления: ".date("d.m.Y H:i");
                                                $mail=mail($query[1],"Recovery password",$message_e,"From: ".$config['admin_mail']);
                                                $update=mysql_query("UPDATE `users` SET `passw`='".md5($passw)."' WHERE `id`='".$query[0]."'");
                                                if($mail AND $update)
                                                {
                                                        msg("Новый пароль успешно отправлен на email!","succes");
                                                }
                                                else
                                                {
                                                        msg("Ошибка при отправке пароля!","warning");
                                                }
                                        }
                                }
                        }
                }
        }
}
echo("
<form action='' method='POST'>
        Для восстановления пароля, введите свой Логин и Email.<br><br>
        <table>
                <tr>
                        <td>Логин*</td><td><input type='text' name='login' value='".$post_array['login']."'></td>
                </tr>
                <tr>
                        <td>Email*</td><td><input type='text' name='email' value='".$post_array['email']."'></td>
                </tr>
                <tr>
                        <td><img src='captcha.php' /><br /></td><td><input type='text' name='captcha' value='".$post_array['captcha']."'></td>
                </tr>
                <tr>
                        <td colspan='2'><br><input type='submit' name='post' value='Восстановить'></td>
                </tr>
        </table>
</form>
");
?>
