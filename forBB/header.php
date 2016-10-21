<?php
header("Content-Type: text/html;charset=utf-8");
include("../pdoConn.class.php");
function __autoload($name)
{
    include "$name.class.php";
}
$design = new design();
if(!$title)
    $title = "TESCOMA &reg; - Интернет-магазин посуды из Чехии";
if(!$url)
    $url = "/";
?>
<!DOCTYPE html>
<html>
<head>
<title><?php print $title ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<link href="/_design/designphp/style.css" rel="stylesheet" type="text/css" />
<script src='/js/jquery-1.6.2.min.js' type='text/javascript' ></script>
<script src='/js/function.js' type='text/javascript' ></script>
<meta name='yandex-verification' content='66f87c667fc83093' />
</head>
<body>
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter5249134 = new Ya.Metrika({id:5249134,
                    webvisor:true,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/5249134" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<div id="mainCont">
        <div id="header">
            <div class="leftYgol">
            </div>
            <div class="rightYgol">
            </div>
            <div id="headerCenter">
                <div class="logoBasket">
                    <a href="<?php print $url?>" title="TESCOMA ® - Интернет-магазин Tescoma интернет магазин посуды из Чехии">
                    <img src="/img/logo.gif" width="320" height="53" alt="TESCOMA ® - Интернет-магазин Tescoma интернет магазин посуды из Чехии">
                    </a>
                </div>
                <div class="slogon">
                    Интернет-магазин
                    <br>
                    посуды из Чехии
                </div>
		<div class="hotlinePhp">
		    Бесплатный звонок<br>
		    <span class="numberhotline"> 8 800 250 24 43</span>
		</div>
                <div class="basketInfo">
                    <img src="/img/basket.gif" width="19" height="16" alt="" class="basket-pad">
                    <a href="/basket.asp">Ваша корзина</a>
                    <span class="items">(<?php print $design->getCountItem(); ?>)</span>
		    <div class="authPhp">
			<a href="http://tescoma-shop.ru/auth">Войти</a>
			&nbsp;<a href="http://tescoma-shop.ru/register">Регистрация</a>
		    </div>
                </div>
            </div>
        </div>
        <!--Вывод главного рубрикатора--> 
            <?php $design->printMainRubricator(); ?>
        <!--Три плашки и контакы справа--> 
        <div class="clear"></div>    
        <div id="p3akr">
            
            <div class="banners" style="background: url(/image.asp?id=<?php print $design->getFieldValue(660); ?>) no-repeat left top;">
                <div class="headBan colHeadBanBlue">
                    <div class="nameSmall">
                        <a href="<?php print $design->getFieldValue(652); ?>"><?php print $design->getFieldValue(650); ?></a>
                    </div>
                    <div class="nameBig">
                        <a href="<?php print $design->getFieldValue(652); ?>"><?php print $design->getFieldValue(651); ?></a>
                    </div>
                </div>
            </div>
            
            <div class="banners" style="background: url(/image.asp?id=<?php print $design->getFieldValue(662); ?>) no-repeat left top;">
                <div class="headBan colHeadBanGreen">
                    <div class="nameSmall">
                        <a href="<?php print $design->getFieldValue(655); ?>"><?php print $design->getFieldValue(653); ?></a>
                    </div>
                    <div class="nameBig">
                        <a href="<?php print $design->getFieldValue(655); ?>"><?php print $design->getFieldValue(654); ?></a>
                    </div>
                </div>
            </div>
            
            <div class="banners" style="background: url(/image.asp?id=<?php print $design->getFieldValue(664); ?>) no-repeat left top;">
                <div class="headBan colHeadBanLime">
                    <div class="nameSmall">
                        <a href="<?php print $design->getFieldValue(658); ?>"><?php print $design->getFieldValue(656); ?></a>
                    </div>
                    <div class="nameBig">
                        <a href="<?php print $design->getFieldValue(658); ?>"><?php print $design->getFieldValue(657); ?></a>
                    </div>
                </div>
            </div>
            
            <div class="contacts">
                <div id="nameContacts">
                    <span class="countName imgPhone">телефон:</span>
                    <span class="countName imgISQ">ICQ:</span>
                    <span class="countName imgSkype">Skype:</span>
                    <span class="countName imgMail">e-mail:</span>
                </div>
                <div id="valContacts">
                    <span class="valCont">+7(913)0305337, +7(391)2918501</span>
                    <span class="valCont">592318783, 380499214</span>
                    <span class="valCont"><a href="callto:tescoma-shop">tescoma-shop</a></span>
                    <span class="valCont"><a href="mailto:info@tescoma-shop.ru">info@tescoma-shop.ru</a></span>
                </div>
            </div>
        </div>