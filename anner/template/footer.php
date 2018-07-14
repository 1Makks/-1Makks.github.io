
<?php

if($omgr==1)
{
echo("");
}

else
{


echo("</div>
		</div>

		<div class='sidebar' id='sideRight'>");


				if(auth===true)
				{
				
	
echo"
<div class='lf1'>
<div class='lf2'>
<div class='lf3'>
Здравствуй, <b>".$user_arr[1]."</b>!

<br />Баланс: <b>".$user_arr[5]."</b> рублей <a href='/money.html'>[Пополнить]</a><sup></sup><br />Холд: <b>".$user_arr[16]."</b> руб.<br />".$config['news']."<div class='clr'></div><div class='stat'></div>";
{if($user_arr[0]=="" OR $user_arr[4]!=1)
{
	echo("<a href='/".$config['admin'].".php'><b>ПУ</b></a>");
}}

echo"<br /><table border='0' width='100%' align='center'><tr><td align='center' width='70'><a href='/webmaster.html'><img src='/template/panel/vitrini.png'><br />Витрины</a></td><td align='center' width='70'><a href='top.html'><img src='/template/panel/top.png'><br />Топ</a></td><td align='center' width='70'><a href='stats.html'><img src='/template/panel/stat.png'><br />Статистика</a></td></tr>
<tr><td colspan='3'><br /></td></tr><tr><td align='center' width='70'><a href='/balance.html'><img src='/template/panel/platezhi.png'><br />Платежи</a></td><td align='center' width='70'><a href='/profile.html'><img src='/template/panel/profil.png'><br />Профиль</a></td><td align='center' width='70'><a href='partner.html'><img src='/template/panel/referali.png'><br />Рефералы</a></td></tr>
<tr><td colspan='3'><br /></td></tr><tr><td align='center' width='70'><a href='/news.html'><img src='/template/panel/news.png' width='48' height='48'><br />Новости</a></td><td align='center' width='70'><a href='/tickets.html'><img src='/template/panel/tickets.png'><br />Тикеты</a></td><td align='center' width='70'><a href='/faq.html'><img src='/template/panel/faq.png' width='48' height='48'><br />FAQ</a></td></tr>
</table><br><p align='center'><a href='/logout.html'>Выход</a></p>
</div></div></div>";
				}
				else
				{
				echo"
<div class='lf1'>
            	<div class='lf2'>
                	<div class='lf3'>
                    	<span class='avt'>Авторизация</span>
                        
                        <form action='/login.html' method='POST'>
							<p class='line'><span class='label'>Логин: </span><input type='text' name='login' /></p>
							<p class='line'><span class='label'>Пароль: </span><input type='password' name='passw' /><a href=''></a></p>
							<div><a href='/registration.html' class='reg'>Регистрация</a></div>
							<div><a href='/recovery.html' class='remindPass'>Забыли пароль</a></div>
							<div><input id='button' type='submit' value='Вход' /></div>
						</form>
					</div>
                </div>
            </div>";
				}
echo("<div id='sld'>
	<div class='sld'>	
            <a href='".$config['s_url']."advert.html&sub=link&undersub=add&id=1'><span class='l1'>Купить</span> <span class='l2'>ссылку</span> <span class='l3'>за</span> <span class='l4'>2</span>  <span class='l5'>рубля</span></a><!--link 2rub-->
             </div>
         </div>
<br style='clear:both'>
     <center><script language='JavaScript' charset='utf-8' src='/codes/link.php?id=1'></script><br><a href='/registration.html&ref=1'><b>Поставить к себе на сайт</b></a></center>
<br>");
mysql_close();
}
				?>
				
				

				
		</div></div></div>
		

			
		

<div id="footer">
<div id="fl">
	
	

	
	
	<table><tr>&copy; Copyright 2014-2015 «You-Link» <td> Все права защищены.<br /> 
	</td></tr></table>
	
</div>	

				
<div id="fr">	


<?php	
     $webmoney = $config['webmoney']; 
	 
    if($webmoney)
    {
	
    echo("<noindex><a href='https://webmoney.ru' rel='nofollow' target='_blank'><img src='/images/webmoney2.png' alt='Мы принимаем Webmoney!' border='0'></a>
	<a href='https://passport.webmoney.ru/asp/certview.asp?wmid=".$config['wmid']."' rel='nofollow' target='_blank'><img src='/images/webmoney.png' alt='Здесь находится аттестат нашего WM идентификатора ".$config['wmid']."' border='0'></a></noindex>");
    } else {
        echo "";
    }   
    

    $payeer = $config['payeer']; 
   if($payeer)
   {
    echo("
    <noindex><a href='https://payeer.com' rel='nofollow' target='_blank'><img src='/images/payeeraccept.png' alt='Мы принимаем Payeer!'  border='0' width='88' height='31'></a></noindex>");
   } else {
      echo "";
   }   	
	
    $robokassa = $config['robokassa']; 
    if($robokassa)
	{
    echo("
	<noindex><a href='https://robokassa.ru' rel='nofollow' target='_blank'><img src='/images/robokassa.png' alt='Мы принимаем RoboKassa!' border='0' width='88' height='31'></a></noindex>");
   } else {
      echo "";
   }   
		?>
<br /><a></a></div>
</div>
</body>
</html>