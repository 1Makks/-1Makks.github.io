<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");

// Подгрузка jQuery
//echo("<script type=\"text/javascript\" src=\"http://code.jquery.com/jquery-1.4.4.min.js\"></script>");

// Вывод страницы
echo("
<script>
        $(document).ready(function()
        {
                $('.sql').click(function()
                {
                        var vast=$(this).attr('aa');
						$('.ap_input').attr({value: vast});
                });
                $('#2').click(function()
                {
                        $('.ap_input').attr({value: 'UPDATE `users` SET `wmr`= WHERE `id`='});
                });
                $('#3').click(function()
                {
                        $('.ap_input').attr({value: 'UPDATE `users` SET `email`= WHERE `id`='});
                });
                $('#4').click(function()
                {
                        $('.ap_input').attr({value: 'SELECT * FROM `abanner`'});
                });
                $('#5').click(function()
                {
                        $('.ap_input').attr({value: 'SELECT * FROM `alink`'});
                });
        });
</script>");
$post_array['sql']=stripslashes(stripslashes($post_array['sql']));
echo("
<a class='sql' aa='UPDATE `users` SET `wmr`= WHERE `id`=' id='2'>[ Кошелек ]</a> 
<a class='sql' aa='UPDATE `users` SET `email`= WHERE `id`=' id='3'>[ Email ]</a> 
<a class='sql' aa='SELECT * FROM `abanner`'id='4'>[ Banner ]</a> 
<a class='sql' aa='SELECT * FROM `alink`'id='5'>[ Link ]</a> <p>

<form action='' method='POST'>
<input type='text' class='ap_input' name='sql' style='width: 500px;' value='".$post_array['sql']."'> <input type='submit' name='post' class='ap_button' value='OK'>
</form><p>");
if(isset($post_array['post']))
{
        if(preg_match("/^SELECT/",$post_array['sql']))
        {
                $query_array=mysql_query($post_array['sql']);
                echo("<table class='ap_list_table'>
                        <tr>");
                while($row=mysql_fetch_assoc($query_array))
                {
                        foreach($row as $key=>$value)
                        {
                                echo("<td class='ap_list_table_td'>$key</td>");
                        }
                        break;
                }
                echo("</tr>");
                $query_array=mysql_query($post_array['sql']);
                while($row=mysql_fetch_assoc($query_array))
                {
                        echo("<tr>");
                        foreach($row as $key=>$value)
                        {
                                echo("<td>$value</td>");
                        }
                        echo("<tr>");
                }
                echo("</table>");
        }
        elseif(preg_match("/^(INSERT|UPDATE|DELETE)/",$post_array['sql']))
        {
                $query=mysql_query($post_array['sql']);
                if($query) msg("Запрос выполнен!","succes"); else msg("Запрос не выполнен!","warning");
        }
}