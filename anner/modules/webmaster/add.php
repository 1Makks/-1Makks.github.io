<script src="http://yandex.st/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");

echo("<title>Витрины : ".$params_array[0]."</title>");

if(auth===FALSE)
{
	msg("Для доступа к данной странице необходима авторизация или <a href='/registration.html'>регистрация</a>!","warning");
}
else
{
	if($get_array['t']=="link")
	{
		if(count($post_array)!=0)
		{
			if($post_array['name']=="")
			{
				$err="Ошибка! Введите Название витрины";
			}
			if(strlen($post_array['name'])>500)
			{
				$err="Ошибка! Длинна поля Название витрины превышает 500 символов";
			}
			if($post_array['url']=="http://" OR $post_array['url']=="")
			{
				$err="Ошибка! Введите URL сайта";
			}
			
			if($post_array['url']=="http://opcat.ru/" OR $post_array['url']=="")
			{
				$err="Данный сайт заблокирован системой!";
			}
			if(strlen($post_array['url'])>500)
			{
				$err="Ошибка! Длинна поля URL превышает 500 символов";
			}
			if(strlen($post_array['atext'])>201)
			{
				$err="Ошибка! Длинна Описания сайта превышает 200 символов";
			}
			if($post_array['dopol']=="")
			{
				$err="Ошибка! Введите поле выделение ссылки";
			}
			if($post_array['price']<1)
			{
				$err="Ошибка! Цена покупки ссылок не менее 1 руб";
			}
			if($post_array['linknum']<1)
			{
				$err="Ошибка! Количество ссылок не менее 1";
			}
			if($post_array['linknum']>50)
			{
				$err="Ошибка! Количество ссылок не более 50";
			}
                                          if($post_array['maxtext']<10)
			{
				$err="Ошибка! Символов должно быть не менее 10";
			}
			if($post_array['maxtext']>100)
			{
				$err="Ошибка! Символов должно быть не более 100";
			}

$count_arr=mysql_fetch_array(mysql_query("SELECT `num` FROM `users` WHERE `id`=".mysql_real_escape_string($user_arr[0]).""));
		              if($count_arr[0]>35)
		              {
			$err="Ошибка! Лимит площадок 35";
		              }

			if($post_array['svoi']==1)
			{
		              $codes=$post_array['codes'];
			}
		              else
			{
		              $codes=0;
			}

			if($err=="")
			{
                                          $i=1+$count_arr[0];
                $insert1=mysql_query("UPDATE `users` SET `num`='".$i."' WHERE `id`='".mysql_real_escape_string($user_arr[0])."'");
				
				$insert=mysql_query("INSERT INTO `tables` VALUES (NULL,'".$user_arr[0]."','".$post_array['url']."',1,2,'".floatval($post_array['price'])."','".intval($post_array['linknum'])."','','".$post_array['maxtext']."','','','','".$post_array['forma']."','".$post_array['name']."','','".$post_array['dopol']."','0','0','".$post_array['red']."','".$post_array['green']."','".$post_array['blue']."','".$post_array['orang']."','".$codes."','0','".$post_array['atext']."','0')");	
				if($insert) header("location: webmaster.html"); else msg("Ошибка при записи в бд","warning");
			}
			else
			{
				msg($err,"warning");
			}
		}
		else
		{
			echo("<b>Добавление витрины ссылок:</b><br><br>
                                                <form name='form' action='' method='POST'>
				<table>
					<tr>
						<td>Название витрины</td><td>&nbsp;&nbsp;<input type='text' name='name' value=''></td>
					</tr>
					<tr>
						<td>Описание сайта</td><td><br>&nbsp;&nbsp;<textarea cols='45' rows='3' name='atext' maxlength='200'></textarea></td>
					</tr>
					<tr>
						<td><br>URL сайта</td><td><br>&nbsp;&nbsp;<input type='text' name='url' value='http://'></td>
					</tr>
					<tr>
						<td><br>Цена<a alt='В эту цену входит ".$config['sys']."% комиссии системы' title='В эту цену не входит ".$config['sys']."% комиссии системы'>*</a></td><td><br>&nbsp;&nbsp;<input type='text' name='price' value='5'>&nbsp;Целое число</td>
					</tr>
					<tr>
						<td><br>Выделение ссылки</td><td><br>&nbsp;
                                                                     <select name='dopol'>
						<option value='0'><font color='red'>Выкл.</font></option>
						<option value='1' selected>1 рубль</option>
						<option value='2'>2 рубля</option>
						<option value='3'>3 рубля</option>
						<option value='4'>4 рубля</option>
						<option value='5'>5 рублей</option>
						<option value='6'>6 рублей</option>
						<option value='7'>7 рублей</option>
						<option value='8'>8 рублей</option>
						<option value='9'>9 рублей</option>
						<option value='10'>10 рублей</option>
						<option value='15'>15 рублей</option>
					</select></td>
					</tr>
					<tr>
						<td><br>Цвет выделения:</td><td>
<table>
<tr><td><br>&nbsp;&nbsp;<font color='red'>Красный</font></td><td><br>&nbsp;&nbsp;<input type='radio' name='red' value='1' checked='checked'>Вкл.</td><td><br>&nbsp;&nbsp;<input type='radio' name='red' value='0'>Выкл.</td></tr>
<tr><td>&nbsp;&nbsp;<font color='green'>Зеленый</font></td><td>&nbsp;&nbsp;<input type='radio' name='green' value='1' checked='checked'>Вкл.</td><td>&nbsp;&nbsp;<input type='radio' name='green' value='0'>Выкл.</td></tr>
<tr><td>&nbsp;&nbsp;<font color='blue'>Синий</font></td><td>&nbsp;&nbsp;<input type='radio' name='blue' value='1' checked='checked'>Вкл.</td><td>&nbsp;&nbsp;<input type='radio' name='blue' value='0'>Выкл.</td></tr>
<tr><td>&nbsp;&nbsp;<font color='orange'>Оранжевый</font></td><td>&nbsp;&nbsp;<input type='radio' name='orang' value='1' checked='checked'>Вкл.</td><td>&nbsp;&nbsp;<input type='radio' name='orang' value='0'> Выкл.</td></tr>
<tr><td><br>&nbsp;&nbsp;Свой </td><td><br>&nbsp;&nbsp;<input type='radio' name='svoi' value='1'>Вкл.</td><td><br>&nbsp;&nbsp;<input type='radio' name='svoi' value='0' checked='checked'>Выкл.</td></tr>
<tr><td>&nbsp;&nbsp;Код цвета:</td><td colspan='2'>&nbsp;&nbsp;<input type='text' name='codes' value='CCCCCC' size='6' maxlength='6'></td></tr>
</table>

</td>
					</tr>
					<tr>
						<td><br>Вид витрины</td><td><br>&nbsp;&nbsp;<input type='radio' name='forma' value='1' checked='checked'> Вертикальная<br>&nbsp;&nbsp;<input type='radio' name='forma' value='2'> Горизонтальная</td>
					</tr>
					<tr>
						<td><br>Ссылок в блоке</td><td><br>&nbsp;&nbsp;<input type='text' name='linknum' value='5'></td>
					</tr>
					<tr>
						<td><br>Длина текста ссылок</td><td><br>&nbsp;&nbsp;<input type='text' name='maxtext' value='25'></td>
					</tr>
					<tr>
						<td colspan='2'><br><input type='submit' value='Добавить'></td>
					</tr>
				</table>
			</form>");
		}
	}
	elseif($get_array['t']=="banners")
	{
		if(count($post_array)!=0)
		{
			if($post_array['name']=="")
			{
				$err="Ошибка! Введите Название витрины";
			}
			if(strlen($post_array['name'])>500)
			{
				$err="Ошибка! Длинна поля Название витрины превышает 500 символов";
			}
			if($post_array['url']=="http://" OR $post_array['url']=="")
			{
				$err="Ошибка! Введите URL сайта";
			}
			if(strlen($post_array['url'])>500)
			{
				$err="Ошибка! Длинна поля URL превышает 500 символов";
			}
			if($post_array['url']=="http://buy-link.ru/" OR $post_array['url']=="")
			{
				$err="Ошибка!";
			}
			if($post_array['url']=="http://buy-link.ru" OR $post_array['url']=="")
			{
				$err="Ошибка!";
			}
			if($post_array['url']=="http://www.buy-link.ru/" OR $post_array['url']=="")
			{
				$err="Ошибка!";
			}
                                          if($post_array['defban']=="http://" OR $post_array['defban']=="")
			{
				$err="Ошибка! Введите URL заглушки";
			}
                                          if(strlen($post_array['defban'])>500)
			{
				$err="Ошибка! Длинна поля URL заглушки превышает 500 символов";
			}
			if(strlen($post_array['atext'])>201)
			{
				$err="Ошибка! Длинна Описания сайта превышает 200 символов";
			}
			if($post_array['price']<1)
			{
				$err="Ошибка! Цена покупки баннера не менее 1 руб";
			}
			if($post_array['w']<0)
			{
				$err="Ошибка! Размер баннера по широте должен > 0";
			}
			if($post_array['d']<0)
			{
				$err="Ошибка! Размер баннера по высоте должен > 0";
			}
$count_arr=mysql_fetch_array(mysql_query("SELECT `num` FROM `users` WHERE `id`=".mysql_real_escape_string($user_arr[0]).""));
		              if($count_arr[0]>50)
		              {
			$err="Ошибка! Лимит площадок 50";
		              }
			if($err=="")
			{
                                          $i=1+$count_arr[0];

                $insert1=mysql_query("UPDATE `users` SET `num`='".$i."' WHERE `id`='".mysql_real_escape_string($user_arr[0])."'");
					$mas_s = preg_split('/x/', $post_array['w'], -1, PREG_SPLIT_NO_EMPTY);
				  $insert=mysql_query("INSERT INTO `tables` VALUES (NULL,'".$user_arr[0]."','".$post_array['url']."',2,2,'".floatval($post_array['price'])."',0,'".$post_array['defban']."','','".$mas_s['0']."','".$mas_s['1']."','','','".$post_array['name']."','','".$post_array['dopol']."','0','0','0','0','0','0','0','1','".$post_array['atext']."','1')");
			   // $insert=mysql_query("INSERT INTO `tables` VALUES (NULL,'".$user_arr[0]."','".$post_array['url']."',2,2,'".floatval($post_array['price'])."',0,'".$post_array['defban']."','','".$mas_s['0']."','".$mas_s['1']."','','','".$post_array['name']."','','".$post_array['dopol']."','0','0','0','0','0','0','0','1','".$post_array['atext']."','".$post_array['slot']."')");

				if($insert) header("location: webmaster.html"); else msg("Ошибка при записи в бд","warning");
			}
			else
			{
				msg($err,"warning");
			}
		}
		else
		{
			echo("<b>Добавление витрины баннеров:</b>
                                                   <br><br>

                                                 <form action='' method='POST'>
				<table>
					<tr>
						<td>Название витрины</td><td>&nbsp;&nbsp;<input type='text' name='name' value=''></td>
					</tr>
					<tr>
						<td>Описание сайта</td><td><br>&nbsp;&nbsp;<textarea cols='45' rows='3' name='atext' maxlength='200'></textarea></td>
					</tr>
					<tr>
						<td><br>URL сайта</td><td><br>&nbsp;&nbsp;<input type='text' name='url' value='http://'></td>
					</tr>
					
					
					<tr>
						<td><br>Размер баннера</td><td id='valu'><br>&nbsp;&nbsp;<select name='w' onchange='fill1();' class='size'>
		<option value='468x60' selected>468 x 60</option>
		<option value='1000x90'>1000 x 90</option>
		<option value='728x90'>728 x 90</option>
		<option value='600x90'>600 x 90</option>
		<option value='300x250'>300 x 250</option>
		<option value='250x250'>250 x 250</option>
		<option value='240x400'>240 x 400</option>
		<option value='234x60'>234 x 60</option>
		<option value='200x300'>200 x 300</option>
		<option value='200x200'>200 x 200</option>
		<option value='160x600'>160 x 600</option>
		<option value='150x150'>150 x 150</option>
		<option value='125x125'>125 x 125</option>
		<option value='120x600'>120 x 600</option>
		<option value='100x100'>100 x 100</option>
		<option value='88x31'>88 x 31</option>
		</select> px
					</td>
					</tr>
					
					<tr>
						<td id='naim'><br>Баннер заглушка</td><td id='valu'><br>&nbsp;&nbsp;<input type='text' class='url_banner' name='defban' value='".$config['s_url']."promo/dummy/468x60.jpg'+$temp+'$('.url_banner').val($temp);'> (png, jpg, gif)</td>
					</tr>
				
					
                    
					<tr>
						<td><br>Цена за неделю<a alt='В эту цену входит ".$config['sys']."% комиссии системы' title='В эту цену входит ".$config['sys']."% комиссии системы'>*</a></td><td><br>&nbsp;&nbsp;<input type='text' name='price' value='10'>&nbsp;Целое число</td>
					</tr>
					
					<tr>
						<td colspan='2'><br><br><br><input type='submit' value='Добавить'></td>
					</tr>
				</table>
			</form><br><br>");
		}
	}
}
?>

<script type="text/javascript">


jQuery.fn.ForceNumericOnly =
function()
{
    return this.each(function()
    {
        $(this).keydown(function(e)
        {
            var key = e.charCode || e.keyCode || 0;
            // Разрешаем backspace, tab, delete, стрелки, обычные цифры и цифры на дополнительной клавиатуре
            return (
                key == 8 ||
                key == 9 ||
                key == 46 ||
                (key >= 37 && key <= 40) ||
                (key >= 48 && key <= 57) ||
                (key >= 96 && key <= 105));
        });
    });
};
$(".b_rr").ForceNumericOnly();
$('.b_rr').change(function(){
	var ss= $(this).val();	
	if(ss>30){
	$(this).val('30');
	alert('Баннеров в ротации не должно быть больше 30');
	}
	if(ss<1){
	$(this).val('1');
	}	
});

function validate1 ( )
{
	valid = true;
       
      
       
    
        if (((document.form5.url.value == "") || (document.form5.url.value == "http://")) && (valid == true))
	{
                alert ('Не заполнено поле «Адрес заглушки»');
	        valid = false;
	}

	temp = document.form5.url_banner.value;
	ext = temp.substring(temp.length-3,temp.length);	
	if ((ext !== 'png') && (ext !== 'gif') && (ext !== 'jpg') && (valid == true))
	{
                alert ('Заглушка в неверном формате');
	        valid = false;
	}
	

       
	return valid;
}

function validate2 ( )
{
	valid = true;
        if ((document.form6.url.value == "") && (document.form6.url_ban.value == ""))
	{
		alert ('Не заполнены поля «Адрес ссылки» и «Адрес картинки»');
		valid = false;
	}
        if ((document.form6.url.value == "") && (valid == true))
	{
                alert ('Не заполнено поле «Адрес ссылки»');
                valid = false;
	}
        if ((document.form6.url_ban.value == "") && (valid == true))
	{
                alert ('Не заполнено поле «Адрес картинки»');
                valid = false;
	}
	temp = document.form6.url_ban.value;
	ext = temp.substring(temp.length-3,temp.length);	
	if ((ext !== 'png') && (ext !== 'gif') && (ext !== 'jpg') && (valid == true))
	{
                alert ('Допустимые форматы баннера: «jpg», «png» и «gif»');
	        valid = false;
	}

	return valid;
}


function fill1 ()
{
	$temp = $('.size option:selected').val();
	$temp= 'http://banners.neoskript.ru/promo/dummy/'+$temp+'.jpg';
	$('.url_banner').val($temp);
}
</script>