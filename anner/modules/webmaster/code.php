<?php
if(!defined("AP")) exit("Доступ к файлу напрямую запрещен!");

echo("<title>Вебмастер : ".$params_array[0]."</title>");

if(auth===FALSE)
{
	msg("Для доступа к данной странице необходима авторизация или <a href='/registration.html'>регистрация</a>!","warning");
}
else
{
	$num_arr=mysql_fetch_array(mysql_query("SELECT * FROM `tables` WHERE `id`='".$get_array['id']."' AND `uid`='".mysql_real_escape_string($user_arr[0])."'"));
	if($num_arr[0]=="")
	{
		msg("Объявление с таким ID нет, либо не пренадлежит вам!","warning");
	}
	else
	{
		if($num_arr[3]==1)
		{
if($num_arr[12]==1 OR $num_arr[12]==0)
{
			echo("<b>Код витрины ссылок:</b><br><br>Установить на свой сайт там, где вы хотите видеть витрину<br><textarea cols='71' rows='6'><a href='".$config['s_url']."advert.html&amp;sub=link&amp;undersub=add&amp;id=".$num_arr[0]."' target='_blank'><b>Купить ссылку здесь</b></a><br>(Цена: ".$num_arr[5]." руб.)<br><br> <script language='JavaScript' charset='windows-1251' src='".$config['s_url']."codes/link.php?id=".$num_arr[0]."'></script><br><a href='".$config['s_url']."registration.html&amp;ref=".$user_arr[0]."'><b>Поставить к себе на сайт</b></a></textarea><br><br>
                            Код состоит из ссылки на покупку рекламы в вашей витрине, далее скрипт самой витрины для вывода рекламы, и ваша реферальная ссылка. Пример установленной витрины:<br><br><img src='img/primer.png'>");
}
if($num_arr[12]==2)
{
			echo("<b>Код витрины ссылок:</b><br><br>Установить на свой сайт там, где вы хотите видеть витрину<br><textarea cols='71' rows='6'><a href='".$config['s_url']."advert.html&amp;sub=link&amp;undersub=add&amp;id=".$num_arr[0]."' target='_blank'><b>Купить ссылку за ".$num_arr[5]."р</b></a> <script language='JavaScript' charset='windows-1251' src='".$config['s_url']."codes/link.php?id=".$num_arr[0]."'></script> | <a href='".$config['s_url']."registration.html&amp;ref=".$user_arr[0]."'><b>Поставить к себе на сайт</b></a></textarea><br><br>
                            Код состоит из ссылки на покупку рекламы в вашей витрине, далее скрипт самой витрины для вывода рекламы, и ваша реферальная ссылка.");
}
		}
		elseif($num_arr[3]==2)
		{
			echo("<b>Код витрины баннера:</b><br><br>Установить на свой сайт там, где вы хотите видеть витрину<br>
			<textarea cols='50' rows='3'><script language='JavaScript' charset='windows-1251' src='".$config['s_url']."codes/banner.php?id=".$num_arr[0]."&amp;s=1'></script></textarea>
                                          <br><br>");
		}
	}
}
?>