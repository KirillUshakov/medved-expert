<?php
	function Declension($name) {
		$city = array('', 'Коломна', 'Балашиха', 'Химки', 'Королёв', 'Красногорск', 'Люберцы', 'Мытищи', 'Одинцово',
  					  'Реутов', 'Видное', 'Зеленоград', 'Апрелевка', 'Долгопрудный', 'Домодедово', 'Жуковский', 'Ивантеевка',
					  'Кубинка', 'Лобня', 'Московский', 'Наро-Фоминск', 'Нахабино', 'Подольск', 'Пушкино', 'Раменское', 'Сергиев Посад',
					  'Солнечногорск', 'Троицк', 'Фрязино', 'Щёлково', 'Волоколамск', 'Голицыно', 'Дедовск', 'Звенигород', 'Истра', 'Лосино-Петровский',
					  'Митино', 'Старая Купавна', 'Щербинка', 'Бронницы', 'Воскресенск', 'Дмитров', 'Дубна', 'Кашира',
					  'Клин', 'Коломна', 'Красноармейск', 'Лыткарино', 'Можайск', 'Монино', 'Ногинск', 'Павловский Посад', 'Руза', 'Солнцево',
					  'Чехов', 'Электрогорск', 'Электросталь', 'Бутово', 'Котельники', 'Октябрьский', 'Сходня', 'Хотьково');
		$city_new = array('', ' в Коломне', ' в Балашихе', ' в Химках', ' в Королёве', ' в Красногорске', ' в Люберцах', ' в Мытищах', ' в Одинцово',
  					  ' в Реутове', ' в Видном', ' в Зеленограде', ' в Апрелевке', ' в Долгопрудном', ' в Домодедово', ' в Жуковском', ' в Ивантеевке',
					  ' в Кубинке', ' в Лобне', ' в Московском', ' в Наро-Фоминске', ' в Нахабино', ' в Подольске', ' в Пушкино', ' в Раменском', ' в Сергиев Посаде',
					  ' в Солнечногорске', ' в Троицке', ' в Фрязино', ' в Щёлково', ' в Волоколамске', ' в Голицыно', ' в Дедовске', ' в Звенигороде', ' в Истре',
					  ' в Лосино-Петровском', ' в Митино', ' в Старой Купавне', ' в Щербинке', ' в Бронницах', ' в Воскресенске', ' в Дмитрове',
                      ' в Дубне', ' в Кашире', ' в Клине', ' в Коломне', ' в Красноармейске', ' в Лыткарино', ' в Можайске', ' в Монино', ' в Ногинске',
                      ' в Павловском Посаде', ' в Рузе', ' в Солнцево', ' в Чехове', ' в Электрогорске', ' в Электростале', ' в Бутово',
                      ' в Котельниках', ' в Октябрьском', ' в Сходне', ' в Хотьково');
		$find_position = array_search($name, $city);

		return $city_new[$find_position];
	}

	$bIndexBot = (strpos($_SERVER['HTTP_USER_AGENT'], 'Lighthouse') !== false);
?>

<!doctype html>
<html <?php language_attributes(); ?> prefix="og: http://ogp.me/ns# article: http://ogp.me/ns/article# profile: http://ogp.me/ns/profile# fb: http://ogp.me/ns/fb#">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="#1d4d96">
	<meta name="cmsmagazine" content="03f22edea940d62437205799198a23fc"/>
	<meta name="google-site-verification" content="ZripkeMgW2HM1f3Qx3sLX6NCM6cuBc5xw1WjpKMky78" />
	<!-- <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/style.min.css?v=1.6.0"> -->
	<meta name="yandex-verification" content="7ac0b5d3a87a120f" />

  <link rel="stylesheet"
			href="<?php echo get_stylesheet_directory_uri(); ?>/fixes.css?v=<?= filemtime( get_stylesheet_directory() . '/fixes.css' ) ?>">
	<?if(!$bIndexBot && is_search_referer()):?>
    <!-- Google Tag Manager -->
    <script>(function(w, d, s, l, i) {
          w[l] = w[l] || [];
          w[l].push({
            'gtm.start':
              new Date().getTime(), event: 'gtm.js'
          });
          var f = d.getElementsByTagName(s)[0],
            j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
          j.async = true;
          j.src =
            'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
          f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-KKV69GZ');</script>
    <!-- End Google Tag Manager -->
	<?endif;?>
	<?php wp_head(); ?>
  <!-- Yandex.Metrika counter -->
  <script type="text/javascript" >
     (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
     m[i].l=1*new Date();
     for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
     k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
     (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

     ym(48605087, "init", {
          clickmap:true,
          trackLinks:true,
          accurateTrackBounce:true,
          webvisor:true,
          ecommerce:"dataLayer"
     });
  </script>
  <!-- /Yandex.Metrika counter -->

	<style>
    .g-recaptcha {
        display: none;
        justify-content: center;
    }

    .wt-header-navigation ul.sub-menu ul.sub-menu {
        left: 100%;
        top: 0;
    }

    .wt-header-navigation li.menu-item-has-children {
      position: relative;
    }

    .loader {
      position: fixed;
      left: 0;
      top: 0;
      right: 0;
      bottom: 0;

      opacity: 0;
      pointer-events: none;

      background-color: #fff;
      transition:  opacity .23s, color .23s, background-color .23s, transform .23s;
      transition-delay: .3s;
      z-index: 9999;
    }

    body.no-js .loader {
      opacity: 1;
      pointer-events: all;
    }

		.number-about-company::before {
			display: none !important;
		}
	</style>

	<?if(!$bIndexBot):?>
    <style>
      .roistat-lh-popup, .roistat-lh-wrap {
        display:none !important;
      }

      .acc .logo {
        display: flex;
        margin: 10px;
        flex-direction: row;
        z-index: 1000;
      }

      .acc .logo a {
        display: block;
        height: 30px;
        width: auto;
        cursor: pointer;
        margin-right: 10px;
      }

      .acc .logo a img {
        height: 100%;
        width: auto;
      }

      .acc .container {
        display: flex;
        flex-direction: column;
        width: 100%;
        max-width: 1000px;
        margin: 0 auto;
        padding: 10px 10px 0 10px;
      }

      .acc .container h1 {
        text-align: center;
        margin-bottom: 30px;
        font-weight: 500;
      }

      .acc .container h2 {
        font-weight: 500;
      }

      .acc .accordion {
        display: flex;
        flex-direction: column;
        width: 100%;
        height: auto;
      }

      .acc .accordion .a-container {
        display: flex;
        flex-direction: column;
        width: 100%;
        padding-bottom: 5px;
      }

      .acc .accordion .a-container .a-btn {
        margin: 0;
        position: relative;
        padding: 15px 30px;
        width: 100%;
        color: #ffffff;
        font-weight: 400;
        display: block;
        font-weight: 500;
        /* background-color: #262626; */
        background-color: #0d47a0;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
        border-radius: 5px;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, .15), 0 10px 10px -5px rgba(0, 0, 0, .1) !important;
      }

      .acc .accordion .a-container .a-btn span {
        display: block;
        position: absolute;
        height: 14px;
        width: 14px;
        right: 20px;
        top: 18px;
      }

      .acc .accordion .a-container .a-btn span:after {
        content: '';
        width: 14px;
        height: 3px;
        border-radius: 2px;
        background-color: #fff;
        position: absolute;
        top: 6px;
      }

      .acc .accordion .a-container .a-btn span:before {
        content: '';
        width: 14px;
        height: 3px;
        border-radius: 2px;
        background-color: #fff;
        position: absolute;
        top: 6px;
        transform: rotate(90deg);
        transition: all 0.3s ease-in-out;
      }

      .acc .accordion .a-container .a-panel {
        width: 100%;
        color: #262626;
        transition: all 0.2s ease-in-out;
        opacity: 0;
        height: auto;
        max-height: 0;
        overflow: hidden;
        padding: 0px 10px;
      }

      .acc .accordion .a-container.active .a-btn {
        color: #fff;
      }

      .acc .accordion .a-container.active .a-btn span::before {
        transform: rotate(0deg);
      }

      .acc .accordion .a-container.active .a-panel {
        padding: 15px 10px 10px 10px;
        opacity: 1;
        max-height: 500px;
      }

      .a-container > p {
        height: 0;
        display: none;
      }

      .money-card .group {
        overflow: hidden;
        margin: 0 -10px;
      }

      .money-card ul {
        float: left;
        width: 33.3%;
        padding: 0 10px;
        margin: 0 auto !important;
        list-style: none !important;
        font: 700 16px/1 'Montserrat', sans-serif !important;
        color: #2c3d53;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
      }

      .money-card li:first-child {
        display: block;
      }

      .money-card li {
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
      }

      .money-card li:before {
        content: none !important;
      }

      #map {
        width: 100%; height: 500px; padding: 0; margin: 0;
      }

      .section-subtitle {
        text-align: center;
        font-size: 15px;
        line-height: 20px;
        color: #878383;
        margin-top: 15px;
      }

      .scheme .scheme-steps {
        list-style-type: none;
        padding-left: 0;
        margin: 60px -15px 0;
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        position: relative;
      }

      .scheme .scheme-steps:before {
        content: '';
        display: block;
        position: absolute;
        width: 75%;
        height: 1px;
        top: 21px;
        left: 0;
        right: 0;
        margin: 0 auto;
        background-color: #e0d7d7;
      }

      .scheme .scheme-steps .step-item {
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -webkit-flex-direction: column;
        -ms-flex-direction: column;
        flex-direction: column;
        -webkit-box-align: center;
        -webkit-align-items: center;
        -ms-flex-align: center;
        align-items: center;
        text-align: center;
        /* width: 25%; */
        width: 30%;
        padding: 0 15px;
        position: relative;
      }

      .scheme .scheme-steps .step-item .item-number {
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: center;
        -webkit-justify-content: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        -webkit-align-items: center;
        -ms-flex-align: center;
        align-items: center;
        font-family: "StolzlMedium", sans-serif;
        font-size: 20px;
        line-height: 24px;
        width: 42px;
        height: 42px;
        border-radius: 50px;
        background-color: #FFC73F;
      }

      .scheme .scheme-steps .step-item .item-icon {
        width: 80px;
        height: 80px;
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: center;
        -webkit-justify-content: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        -webkit-align-items: center;
        -ms-flex-align: center;
        align-items: center;
        background-color: #ffffff;
        border-radius: 10px;
        margin-top: 32px;
        -webkit-box-shadow: 0px 8px 10px #d5d4d3;
        box-shadow: 0px 8px 10px #d5d4d3;
      }

      .scheme .scheme-steps .step-item .item-info {
        margin-top: 28px;
        line-height: 21px;
      }

      .scheme .scheme-steps .step-item .item-icon img {
        width: 55px;
        height: 55px;
        -o-object-fit: scale-down;
        object-fit: scale-down;
      }

      .scheme .scheme-steps .step-item .item-info a:hover {
        color: #FFC73F;
      }

      .scheme .scheme-steps .step-item .item-info a {
        color: #000000;
        text-decoration: none;
        -webkit-transition: color .2s ease;
        -o-transition: color .2s ease;
        transition: color .2s ease;
        font-weight: bolder;
      }

      #prev-scheme-steps {
        position: relative;
        display: block;
        width: 50px;
        height: 40px;
        background: #f2ca10;
        background: linear-gradient(to bottom,#f2ca10 0,#eead0b 100%);
        border-radius: 10px;
        margin-bottom: 15px;
        display: none;
      }

      #prev-scheme-steps:before {
        position: absolute;
        content: '';
        width: 20px;
        height: 14px;
        background-image: url(https://balashiha.medved-expert.ru/wp-content/themes/walnutmaker/img/svg/top.svg);
        top: 50%;
        margin-top: -7px;
        left: 50%;
        margin-left: -10px;
        transform: rotate(-90deg);
      }

      #next-scheme-steps {
        position: relative;
        display: block;
        width: 50px;
        height: 40px;
        background: #f2ca10;
        background: linear-gradient(to bottom,#f2ca10 0,#eead0b 100%);
        border-radius: 10px;
        margin-bottom: 15px;
        display: none;
      }

      #next-scheme-steps:before {
        position: absolute;
        content: '';
        width: 20px;
        height: 14px;
        background-image: url(https://balashiha.medved-expert.ru/wp-content/themes/walnutmaker/img/svg/top.svg);
        top: 50%;
        margin-top: -7px;
        left: 50%;
        margin-left: -10px;
        transform: rotate(90deg);
      }

      .document-list {
        font-size: 0;
        line-height: 0;
        margin: 0 -10px 38px !important;
        padding: 10px 0;
      }

      .document-list li {
        display: inline-block;
        vertical-align: top;
        margin: 0 0 25px;
        font: 600 18px/22px 'Montserrat', sans-serif !important;
        color: #333333;
        text-align: center;
        width: 25%;
        padding: 0 10px;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
      }

      .document-list .holder-img {
        position: relative;
        max-width: 135px;
        margin: 0 auto 27px;
        border-radius: 50%;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
      }

      .document-list .holder-img:before {
        content: '';
        position: absolute;
        right: -15px;
        top: 0;
        /* background: url(/wp-content/uploads/law-documents/bg-38.png) no-repeat; */
        background: url(/wp-content/uploads/law-documents/checkmark2.svg) no-repeat;
        width: 31px;
        height: 31px;
        border-radius: 50%;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
      }

      .document-list img {
        display: block;
        max-width: 100%;
      }

      .document-list p {
        font-weight: 600;
        line-height: 1 !important;
        letter-spacing: 0;
        font-family: "Fira Sans","Helvetica Neue",Helvetica,Arial,sans-serif;
      }

      .document-list span {
        display: block;
        font-weight: 400;
        /* font-size: 16px; */
        font-size: 18px;
        line-height: 1.5;
      }

      .law .law-documents {
        margin-top: 45px;
      }

      .law .law-documents .documents-group .group-title {
        font-family: "StolzlBold", sans-serif;
        font-size: 14px;
        line-height: 22px;
        text-transform: uppercase;
        color: #535151;
          font-weight: bolder;
      }

      .law .law-documents .documents-group .group-list {
        list-style-type: none;
        padding-left: 0;
        margin: 28px 0 0;
      }

      .law .law-documents .documents-group .group-item span {
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -webkit-align-items: center;
        -ms-flex-align: center;
        align-items: center;
        line-height: 22px;
        color: #535151;
        position: relative;
        margin-left: -40px;
      }

      .law .law-documents .documents-group .group-item span:before {
        content: '';
        display: inline-block;
        width: 24px;
        height: 24px;
        margin-right: 12px;
        background: url(/wp-content/uploads/law-documents/checkmark2.svg) 50% 50% no-repeat;
        background-size: cover;
        -webkit-flex-shrink: 0;
        -ms-flex-negative: 0;
        flex-shrink: 0;
      }

      .law .law-documents .documents-group .group-item img {
        width: 40px;
        height: 56px;
        -o-object-fit: scale-down;
        object-fit: scale-down;
        margin-right: 30px;
        -webkit-flex-shrink: 0;
        -ms-flex-negative: 0;
        flex-shrink: 0;
      }

      .law .law-documents .documents-group .group-item {
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -webkit-align-items: center;
        -ms-flex-align: center;
        align-items: center;
        margin-bottom: 32px;
      }

      /* Start:/kalkulyator/style.css?16177115715852*/
      .calc-wrap {
        padding: 0 25px 30px;
        /* background: #2c4668; */
        background: #11489d;
        margin: 0 auto;
      }
      .calc-wrap:after{
        content: '';
        display: block;
        clear: both;
      }
      .calc-wrap .calc {
        padding: 0!important;
        background: transparent!important;
        border: none!important;
        margin: 0 0 10px;
        color: #fff;
        font-size: 25px;
        font-weight: 600;
      }
      #calc .col {
        float: left;
        margin-top: 16px;
      }
      #calc .col1 {
        width: 38%;
        margin-right: 0;
      }
      #calc .col2 {
        width: 34.175691937425%;
        margin-right: 0;
      }
      #calc .col3 {
        width: 25%;
        margin-left: 0;
      }
      #calc .bitem {
        -o-border-radius: 10px;
        -moz-border-radius: 10px;
        -webkit-border-radius: 10px;
        border-radius: 10px;
        margin: 0 0 8px;
        position: relative;
      }
      .selSpos:after,
      #calc .bitem:after{
        content: '';
        display: block;
        clear: both;
      }
      #calc .titol {
        font: 700 14px/1.2px 'PT Sans',sans-serif;
        color: #dcdcdc;
        text-align: left;
        position: relative;
        margin: 0;
        margin-bottom: 20px;
      }
      .selSpos {
        float: left;
        width: 96%;
        margin-left: -3px;
      }
      .selSpos .active, .selSpos .item:hover {
        border: 1px solid #d3e0e5;
        background: #eead0b!important;
      }
      #calc .titol .number {
        width: 40px;
        height: 40px;
        box-sizing: border-box;
        padding-top: 15px;
        color: #ffffff;
        border: 4px solid #000;
        margin-right: 10px;
        text-align: center;
        vertical-align: middle;
        font-size: 25px;
        display: inline-block;
        border-radius: 50%;
        border-color: #eead0b;
      }
      .podmosc.rayon .tsel p{
        color: #fff!important;
      }
      .selSpos .item {
        position: relative;
        width: 48%;
        height: 131px;
        display: block;
        float: left;
        text-align: center;
        margin: 1px;
        cursor: pointer;
        padding: 21px 0 0;
        border: 1px solid #898989;
        border-radius: 3px;
      }
      .selSpos .item:first-child img {
        margin-left: 20px;
      }
      .blink {
        padding-left: 3px;
        padding-right: 3px;
        border-bottom: none!important;
      }
      .selSpos .item a {
        color: #fff;
        text-decoration: none;
      }
      .selSpos .item:nth-of-type(1) .blink, .selSpos .item:nth-of-type(2) .blink {
        top: -4px;
        position: relative;
      }
      .selSpos .item:nth-of-type(1) .blink, .selSpos .item:nth-of-type(2) .blink {
        top: -4px;
        position: relative;
      }
      .selSpos .item:nth-of-type(4) .blink {
        position: relative;
      }
      .step3 .mini-menu {
        text-align: left;
        margin: 22px 0 45px;
      }
      .step3 .mini-menu a {
        font: 14px/1.2 'PT Sans',sans-serif;
        color: #dcdcdc;
        text-decoration: none;
        padding: 12px 20px;
        border-bottom: none;
        position: relative;
        top: 6px;
      }
      .mini-menu a[value=mosc] {
        margin-left: 12px;
      }
      .mini-menu a[value=podmosc] {
        margin-left: 12px;
        padding-right: 0;
        padding-left: 0;
      }
      .step3 .mini-menu a.active {
        position: relative;
        top: 6px;
        color: #fff;
        /* border: 2px solid #0d897f; */
        text-decoration: none;
        border: 2px solid #ffffff;
      }
      .step3 .mini-menu a span {
        border-bottom: 1px dotted #000;
      }
      .step3 .mini-menu a.active span {
        border: none;
      }
      .mosc.rayon ul {
        padding: 0;
      }
      .mosc.rayon ul li {
        background: #546984 ;
        color: #fff;
        padding: 3px 10px;
        display: inline-block;
        width: 26%;
        margin: 2% 5% 2% 0;
        font-size: 16px;
        cursor: pointer;
        box-sizing: border-box;
      }
      .mosc.rayon ul li.active {
        padding-left: 24px;
        background: url(/wp-content/uploads/calc/galka.png) no-repeat 0 6px;
        color: #dc3e30;
      }
      .podmosc.rayon .tsel {
        padding-left: 30px;
      }
      .tsel p {
        color: #fff;
      }
      .podmosc.rayon p {
        color: #939393;
      }
      #content .podmosc.rayon ul{
        padding: 0;
        margin: 0;
      }
      .podmosc.rayon ul li {
        width: 40%;
        margin: 10px 5% 0 0;
        display: inline-block;
        color: #fff;
        padding-left: 36px;
        background: url(/wp-content/uploads/calc/li-inactive.png) no-repeat;
        cursor: pointer;
        height: 24px;
        font-size: 16px;
      }
      .podmosc.rayon ul li.active {
        background: url(/wp-content/uploads/calc/li-active.png) no-repeat;
      }
      .center {
        max-width: 80%!important;
        display: inline!important;
        margin-bottom: 15px;
      }
      .step4 p {
        clear: both;
        margin: 0 0 4px;
      }
      .step4 .titol {
        margin-bottom: 18px;
      }
      .hide, .time-clock, .error-hidden {
        display: none;
      }
      #calc .timer {
        position: relative;
        display: inline-block;
        height: 51px;
        z-index: 999;
        text-align: center;
        margin-top: 2px;
        color: #fff;
      }
      .time-clock > img {
        margin: 10px;
        padding-left: 50px;
      }
      .time-pro p:first-child {
        height: 112px;
        background: #2c4668;
        color: #fff;
        padding-top: 25px;
        border: 1px solid #d3e0e5;
        border-radius: 5px;
        margin-bottom: 30px;
        text-align: center;
        font-size: 40px;
        font-weight: 700;
      }
      .time-pro p{
        color: #fff!important;
      }
      .step4 .recalculate {
        padding-top: 11px;
      }
      #calc .submit {
        cursor: pointer;
        display: block;
        vertical-align: middle;
        width: 208px;
        background: #eead0b;
        height: 42px;
        color: #ffffff!important;
        font: 700 16px/1.2 'PT Sans',sans-serif;
        text-align: center;
        border: none;
        width: 100%;
      }
      span.error {
        margin: 0;
        width: 260px;
        padding: 10px;
        font-style: italic;
        color: #a87878;
      }

      .selSpos .item:first-child img {
        margin-left: 20px;
      }

      #add_review>input,textarea {
        background-color: #fff;
        height: 55px;
        border: 2px solid #fff;
        padding: 0 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-family: &quot;Fira Sans&quot;,&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;
        font-size: 16px;
        color: #252525;
        border-color: #1c4e9c;
        line-height: 1.5;
        width: 40%;
      }

      #add_review>textarea {
        height: 120px;
      }

      .call-worker {
        display: inline-block;
        margin-bottom: 0;
        text-align: center;
        vertical-align: middle;
        touch-action: manipulation;
        cursor: pointer;
        background-image: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        border: none;
        transform: skewX(-15deg);
        font-weight: 500;
        padding: 10px 65px;
        font-size: 21px;
        line-height: 32px;
        border-radius: 10px;
        color: #252525;
        background: #eead0b;
        background: linear-gradient(to bottom,#eead0b 0,#f2ca10 50%,#eead0b 100%);
        background-size: auto 200%;
        background-position: left bottom;
        font-size: 16px;
        padding: 19px;
        text-align: center;
      }

      @media screen and (max-width: 1060px){
        #calc .titol{
          font-size: 12px;
        }
        .selSpos .item {
          font-size: 14px;
        }
        .step3 .mini-menu a {
          padding: 12px 10px;
        }
        .mini-menu a[value=podmosc] {
          padding-right: 0;
          padding-left: 0;
        }
      }
      @media screen and (max-width: 700px){
        .calc-wrap {
          text-align: center;
          padding: 0 2%;
        }
        .calc-wrap .col {
          width: 100%!important;
        }
        .selSpos {
          width: 100%;
          margin-left: -1%;
        }
        .selSpos .item {
          width: 48%;
          margin: 1px 0 2px 1%;
        }
        #calc .titol{
          font-size: 18px;
        }
      }

      #mosc, #podmosc {
        cursor: pointer;
      }

      @media (max-width: 991.98px) {
        .scheme .scheme-inner {
          width: 100%;
          overflow-x: auto;
        }
      }

      @media (max-width: 767.98px) {
        .scheme .scheme-steps {
          margin-top: 40px;
          width: 840px;
        }
      }

      @media (max-width: 575.98px) {
        .scheme .scheme-steps {
          width: 720px;
        }
      }

      @media (max-width: 439.98px) {
        .scheme .scheme-steps {
          margin-top: 30px;
          /* width: 840px; */
          display: block;
          text-align: center;
          width: 100%;
          padding: 35px 0 0 0;
          margin: 0;
        }

        .scheme .scheme-steps .step-item {
          width:100%;
          margin-bottom: 50px;
        }

        .scheme .scheme-steps:before {
          display: none;
        }

        #prev-scheme-steps {
          /* display: inline; */
          display: none;
        }
        #next-scheme-steps {
          /* display: inline; */
          display: none;
        }

        #add_review>input,textarea {
          width: 100%;
        }
      }


      @media screen and (max-width: 680px) {
        .document-list li {
          /* width: 50%; */
          width: 100%;
        }
      }

      @media (max-width: 439.98px) {
        .law .law-documents .documents-group .group-list {
          margin-top: 17px;
        }
      }

      @media (max-width: 439.98px) {
        .law .law-documents .documents-group .group-item {
          margin-bottom: 20px;
        }
      }

      /* End */

      .rating__group {
        position: relative;
        width: calc(var(--star_width) * 5);
        height: var(--star_width);
        background-image: var(--star_bg);
        background-size: var(--star_width) auto;
        background-repeat: repeat-x;
        background-color: transparent;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
      }

      .rating__star {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        position: absolute;
        top: 0;
        left: 0;
        height: var(--star_width);
        margin: 0;
        font-size: inherit;
        background-size: var(--star_width) auto;
        background-repeat: repeat-x;
        background-color: transparent;
        cursor: pointer;
        opacity: 1;
        border: none;
        border-radius: 0;
        transition: 0.2s;
      }

      .rating__star:focus {
        outline: none;
      }

      .rating__star:checked,
      .rating__star:hover {
        background-image: var(--star_bg_fill);
        width: var(--star_width);
        height: var(--star_width);
        background-size: var(--star_width);
      }

      .rating__star:hover~.rating__star {
        background-image: var(--star_bg);
      }

      .rating__star:nth-child(1) {
        width: var(--star_width);
        z-index: 5;
      }

      .rating__star:nth-child(2) {
        width: calc(var(--star_width)* 2);
        z-index: 4;
      }

      .rating__star:nth-child(3) {
        width: calc(var(--star_width)* 3);
        z-index: 3;
      }

      .rating__star:nth-child(4) {
        width: calc(var(--star_width)* 4);
        z-index: 2;
      }

      .rating__star:nth-child(5) {
        width: calc(var(--star_width)* 5);
        z-index: 1;
      }

      :root {
        --star_width: 22px;
        --star_bg: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' %3E%3Cpath style='fill:%23DADADA' d='M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z'/%3E%3C/svg%3E");
        --star_bg_fill: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' %3E%3Cpath style='fill:%236A1B9A' d='M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z'/%3E%3C/svg%3E");
      }


    </style>

    <script>
      function initAcc(elem, option) {
        document.addEventListener('click', function (e) {
          if (!e.target.matches(elem + ' .a-btn')) return;
          else {
            if (!e.target.parentElement.classList.contains('active')) {
              if (option == true) {
                var elementList = document.querySelectorAll(elem + ' .a-container');
                Array.prototype.forEach.call(elementList, function (e) {
                  e.classList.remove('active');
                });
              }
              e.target.parentElement.classList.add('active');
            } else {
              e.target.parentElement.classList.remove('active');
            }
          }
        });
      }

      initAcc('.accordion.v1', true);
      initAcc('.accordion.v2', false);
    </script>

    <?if(!$bIndexBot):?>
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru-RU&amp;apikey=d0ec6b69-75cf-4662-8727-7c9e71a36803" type="text/javascript"></script>
    <script src="https://yandex.st/jquery/2.2.3/jquery.min.js" type="text/javascript"></script>
    <script src="/wp-content/themes/walnutmaker/js/yamap.js" type="text/javascript" async defer></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <?endif;?>
    <script src="/wp-content/themes/walnutmaker/js/custom_scripts.js" type="text/javascript"></script>

    <?php if (is_search_referer()) : ?>
      <script src="/wp-content/themes/walnutmaker/js/custom_script_ya.js" type="text/javascript"></script>
    <?php else: ?>
      <script>
        var ym = () => {};
      </script>
    <?php endif; ?>

	<?endif;?>

</head>

<body <?php body_class('no-js'); ?>>
  <!-- Yandex.Metrika counter -->
  <noscript><div><img src="https://mc.yandex.ru/watch/48605087" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
  <!-- /Yandex.Metrika counter -->
	<header class="wt-header">
		<div class="wt-header-main">
			<div class="container">
				<div class="wt-header-wrap">
					<?php
						$description = get_bloginfo( 'description', 'display' );
						$phone = wt_options( 'phone' );
						$email = wt_options( 'email' );
						$callback = get_field( 'callback-link', wm_field_option() );
					?>
					<div class="wt-header-brand wt-header-brand-full">
						<div class="wt-header-brand-wrap">
							<?php if( wt_logo( 'header_logo', true ) ) { ?>
								<div class="wt-header-logo">
									<?php
										echo $_SERVER[ 'REQUEST_URI' ] != '/' ? '<a href="' . esc_url( home_url() ) .
											'" rel="home">' : '';
										//echo wt_logo();
										echo '<img src="'.wt_logo( 'header_logo', true )[0].'" class="attachment-full size-full" alt="Медведь Эксперт" loading="lazy">';
                    //echo '<img src="https://medved-expert.ru/wp-content/uploads/2023/12/medved.svg" class="attachment-full size-full" alt="" loading="lazy">';
										echo $_SERVER[ 'REQUEST_URI' ] != '/' ? '</a>' : '';
									?>
								</div>
							<?php } ?>
							<div class="wt-header-name">
								<?php if( is_front_page() ) { ?>
									<p class="wt-header-name-title">
										<?php
											echo $_SERVER[ 'REQUEST_URI' ] != '/' ? '<a href="' .
												esc_url( home_url() ) . '" rel="home">' : '';
											echo get_field( 'site-name', wm_field_option() ) ? : get_bloginfo( 'name',
												'display' );
											echo $_SERVER[ 'REQUEST_URI' ] != '/' ? '</a>' : '';
										?>
										<?php echo Declension(get_bloginfo( 'name','display' )); ?>
									</p>
								<?php } else { ?>
									<p class="wt-header-name-title">
										<?php
											echo $_SERVER[ 'REQUEST_URI' ] != '/' ? '<a href="' .
												esc_url( home_url() ) . '" rel="home">' : '';
											echo get_field( 'site-name', wm_field_option() ) ? : get_bloginfo( 'name',
												'display' );
											echo $_SERVER[ 'REQUEST_URI' ] != '/' ? '</a>' : '';
										?>
									</p>
								<?php } ?>
							</div>
						</div>
					</div>
					<div class="wt-header-action">
            <a href="javascript:;" class="callback-header-btn">
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
									width="25px" height="36px">
								<path fill-rule="evenodd" fill="rgb(37, 37, 37)"
										d="M24.942,25.564 C24.405,33.014 21.796,33.428 21.618,35.955 L11.876,36.001 C11.806,34.031 9.714,33.085 8.220,31.268 C6.714,29.434 6.207,26.790 1.201,24.987 C-0.686,24.308 -0.035,22.810 1.051,22.250 C2.807,21.340 4.021,22.427 5.798,23.449 C7.323,24.326 9.084,24.469 9.307,23.536 C9.671,22.017 9.672,21.276 9.822,19.187 C9.936,17.524 10.109,14.515 10.311,11.658 C10.578,7.826 10.874,6.113 12.341,6.218 C13.920,6.340 13.975,8.729 13.668,11.889 C13.316,15.486 13.225,17.104 13.501,17.122 C13.987,17.160 13.904,15.529 15.171,15.626 C16.755,15.748 16.613,17.003 17.053,17.037 C17.497,17.066 17.787,15.855 19.054,15.952 C20.318,16.053 20.365,17.724 20.892,17.757 C21.409,17.796 21.588,17.270 22.373,17.336 C23.154,17.394 25.371,19.636 24.942,25.564 ZM14.988,11.264 C15.060,10.347 15.104,9.433 15.044,8.588 C15.184,8.365 15.311,8.129 15.406,7.870 C16.096,5.977 15.161,3.856 13.317,3.146 C11.473,2.437 9.413,3.399 8.720,5.298 C8.262,6.553 8.533,7.903 9.299,8.880 C9.197,9.630 9.136,10.429 9.079,11.231 C7.006,9.833 6.069,7.111 6.975,4.627 C8.029,1.739 11.160,0.271 13.972,1.353 C16.783,2.434 18.205,5.653 17.151,8.541 C16.723,9.712 15.940,10.638 14.988,11.264 Z"/>
							</svg>
							<span>Срочный вызов мастера</span> </a>
						<p class="wt-header-action-tip">Мы работаем круглосуточно <span>24/7</span></p>
						<div class="wt-search-form wt-search-form-header" style="display:none;"><?php wt_form_search(); ?></div>
					</div>
					<?php if( ( $phone && $phone[ 'href' ] ) || ( $email && $email[ 'href' ] ) || $callback ) { ?>
						<div class="wt-header-contacts">
							<?php if( $phone && $phone[ 'href' ] ) { ?>
								<p class="wt-header-contacts-phone hidden-touch">
									<a href="<?php echo $phone[ 'href' ]; ?>" <?php echo $phone[ 'target' ]
										? 'target="_blank"' : ''; ?> class="me_phone">
										<?php echo $phone[ 'title' ]; ?>
									</a>
								</p>
							<?php } ?>
							<?php if( $email && $email[ 'href' ] ) { ?>
								<p class="wt-header-contacts-email hidden-touch">
									<a href="<?php echo $email[ 'href' ]; ?>" <?php echo $email[ 'target' ]
										? 'target="_blank"' : ''; ?>>
										<?php echo $email[ 'title' ]; ?>
									</a>
								</p>
							<?php } ?>
							<div class="messenger-links">
                                <a title="Позвонить" href="tel:+74957603375"><img src="/wp-content/themes/walnutmaker/img/icons/phone-icon.svg" alt="Позвонить"></a>
                                <a title="Whatsapp" href="whatsapp://send?phone=79162680238"><img src="/wp-content/themes/walnutmaker/img/icons/whatsapp-icon.svg" alt="Whatsapp" style="width:36px;"></a>
                                <a title="Viber" href="viber://chat?number=%2B79162680238"><img src="/wp-content/themes/walnutmaker/img/icons/viber-icon.svg" alt="Viber"></a>
                                <a title="Telegram" href="https://t.me/medved_expert?roistat_visit=202398"><img src="/wp-content/themes/walnutmaker/img/icons/telegram-icon.svg" alt="Telegram"></a>
                            </div>
							<ul class="wt-footer-contacts-social" style="display: none;">
								<li>
									<noindex>
										<a href="https://t.me/MedvedExpertBot" target="_blank" rel="nofollow">
											<svg id="tg" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" style="fill: black;">
												<path d="M23.52 5.14L3.08 13.36c-1.4.59-1.39 1.4-.25 1.76l5.09 1.66L9.87 23c.24.67.12.95.81.95a1.31 1.31 0 0 0 1.06-.56l2.55-2.59 5.31 4.09c1 .57 1.67.28 1.92-.94L25 6.86c.36-1.49-.55-2.16-1.48-1.73zM8.72 16.4l11.49-7.55c.58-.36 1.1-.17.67.23L11 18.33l-.39 4.26-1.88-6.19z"></path>
											</svg>
										</a>
									</noindex>
								</li>
								<li>
									<noindex><a href="https://vk.com/medved.expert?roistat_visit=196388" target="_blank" rel="nofollow">
											<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 14.171 14.171" style="fill: black;">
												<path
													d="M13.268 0H.905C.405 0 0 .405 0 .904v12.363c0 .499.405.904.905.904h12.362a.904.904 0 0 0 .904-.904V.904A.902.902 0 0 0 13.268 0zm-1.513 8.635c.259.264.821.707.719 1.158-.094.414-.712.263-1.312.287-.685.029-1.091.044-1.503-.287-.194-.157-.308-.343-.494-.551-.169-.188-.382-.525-.672-.512-.521.026-.358.752-.543 1.247-2.896.456-4.059-1.333-5.085-3.069-.497-.841-1.215-2.647-1.215-2.647l2.048-.007s.657 1.195.831 1.503c.148.262.311.47.479.704.141.194.364.574.608.543.397-.051.469-1.591.223-2.107-.098-.209-.333-.282-.576-.353.082-.518 2.297-.626 2.655-.224.52.584-.36 2.21.352 2.684 1-.524 1.854-2.718 1.854-2.718l2.398.015s-.375 1.186-.768 1.712c-.229.308-.989.994-.959 1.503.024.403.642.795.96 1.119z">
												</path>
											</svg>
										</a>
									</noindex>
								</li>
								<li>
									<noindex>
										<a href="https://www.facebook.com/medved.expert/?roistat_visit=196388" target="_blank" rel="nofollow">
											<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 60.734 60.733"
												style="fill: black;">
												<path
													d="M57.378.001H3.352A3.352 3.352 0 0 0 0 3.353v54.026a3.353 3.353 0 0 0 3.352 3.354h29.086V37.214h-7.914v-9.167h7.914v-6.76c0-7.843 4.789-12.116 11.787-12.116 3.355 0 6.232.251 7.071.36v8.198l-4.854.002c-3.805 0-4.539 1.809-4.539 4.462v5.851h9.078l-1.187 9.166h-7.892v23.52h15.475a3.355 3.355 0 0 0 3.355-3.351V3.351a3.352 3.352 0 0 0-3.354-3.35z">
												</path>
											</svg>
										</a>
									</noindex>
								</li>
								<li>
									<noindex>
										<a href="https://www.instagram.com/medved.expert/?roistat_visit=196388" target="_blank" rel="nofollow">
											<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 510 510"
												style="fill: black;">
												<path
													d="M459 0H51C22.95 0 0 22.95 0 51v408c0 28.05 22.95 51 51 51h408c28.05 0 51-22.95 51-51V51c0-28.05-22.95-51-51-51zM255 153c56.1 0 102 45.9 102 102s-45.9 102-102 102-102-45.9-102-102 45.9-102 102-102zM63.75 459C56.1 459 51 453.9 51 446.25V229.5h53.55C102 237.15 102 247.35 102 255c0 84.15 68.85 153 153 153s153-68.85 153-153c0-7.65 0-17.85-2.55-25.5H459v216.75c0 7.65-5.1 12.75-12.75 12.75H63.75zM459 114.75c0 7.65-5.1 12.75-12.75 12.75h-51c-7.65 0-12.75-5.1-12.75-12.75v-51c0-7.65 5.1-12.75 12.75-12.75h51C453.9 51 459 56.1 459 63.75v51z">
												</path>
											</svg>
										</a>
									</noindex>
								</li>
								<li>
									<noindex>
										<a href="https://www.youtube.com/channel/UC3X6TIehBQ27J09_ZKQxjYw?roistat_visit=196388" target="_blank"
											rel="nofollow">
											<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 18.136 18.136"
												style="fill: black;">
												<path
													d="M16.281.001H1.855A1.854 1.854 0 0 0 0 1.855v14.426c0 1.025.831 1.854 1.855 1.854h14.426a1.853 1.853 0 0 0 1.855-1.854V1.855c0-1.025-.83-1.854-1.855-1.854zm-5.834 3.062h.883v2.785c0 .535.017.519.035.586.019.071.083.238.29.238.22 0 .281-.176.298-.251.014-.065.03-.052.03-.61V3.063h.882v4.18h-.894l.011-.211-.272-.113a.799.799 0 0 1-.247.31.577.577 0 0 1-.342.104.64.64 0 0 1-.37-.098.536.536 0 0 1-.198-.24 1.195 1.195 0 0 1-.086-.346c-.013-.135-.02-.414-.02-.83V3.063zM7.379 4.801c0-.436.037-.773.107-1.012.066-.221.183-.395.358-.529.178-.139.413-.208.699-.208.244 0 .453.048.624.138.166.088.294.203.381.338.089.142.151.287.184.433.034.152.051.398.051.73v.736c0 .432-.017.747-.048.941a1.36 1.36 0 0 1-.195.504.907.907 0 0 1-.379.341 1.314 1.314 0 0 1-.567.117c-.244 0-.451-.034-.617-.104a.75.75 0 0 1-.354-.273 1.298 1.298 0 0 1-.183-.461c-.04-.194-.06-.496-.06-.899l-.001-.792zM5.314 1.574l.718 2.311c.125-.604.367-1.44.559-2.311h.651l-.838 3.297-.006.026v2.344h-.763V4.897l-.006-.025-.966-3.298h.651zm10.394 12.927c-.114 1.04-1.037 1.892-2.072 1.962-3.048.131-6.087.131-9.134 0-1.036-.07-1.958-.922-2.073-1.962a35.557 35.557 0 0 1 0-4.907c.114-1.04 1.037-1.89 2.073-1.963 3.047-.13 6.086-.13 9.134 0 1.036.073 1.958.923 2.072 1.963a35.245 35.245 0 0 1 0 4.907zM8.581 6.83c.128 0 .228-.077.273-.21.021-.061.046-.177.046-.493V4.316c0-.366-.021-.484-.043-.551-.045-.136-.144-.215-.273-.215-.127 0-.227.076-.274.211-.024.065-.048.186-.048.555v1.761c0 .346.025.465.047.532.046.14.145.221.272.221zM3.617 9.91h.863v4.851h.904V9.91h.865v-.92H3.617v.92zm4.275 3.195c0 .521-.015.65-.027.705-.031.135-.139.217-.291.217-.145 0-.25-.078-.284-.207-.015-.055-.031-.184-.031-.68v-2.757h-.856v3.004c0 .396.006.66.018.79.012.119.043.237.091.348.043.1.108.177.199.236.088.061.205.09.346.09a.547.547 0 0 0 .318-.094.774.774 0 0 0 .246-.301l.271.066-.012.244h.868v-4.383h-.855l-.001 2.722zm3.786-2.5a.512.512 0 0 0-.205-.215.676.676 0 0 0-.338-.078.558.558 0 0 0-.304.086.901.901 0 0 0-.27.281l-.261.403V8.991h-.856v5.771h.808l.05-.257.07-.358.19.308a.98.98 0 0 0 .275.306c.093.062.19.094.296.094.15 0 .276-.053.386-.156a.73.73 0 0 0 .217-.389c.034-.168.051-.434.051-.416v-2.291c0 .01.034-.228-.017-.701a.803.803 0 0 0-.092-.297zm-.745 2.543c0 .41-.021.535-.038.6-.04.141-.141.223-.277.223-.132 0-.233-.078-.275-.215-.02-.062-.042-.184-.042-.559v-1.161c0-.39.02-.507.038-.563a.276.276 0 0 1 .272-.207c.135 0 .237.082.28.221.019.061.044.183.044.551v1.111l-.002-.001zm2.339-.446h1.478v-.476c0-.431-.04-.925-.119-1.156a1.026 1.026 0 0 0-.389-.528c-.181-.128-.419-.195-.706-.195-.233 0-.441.054-.618.163s-.3.262-.378.469c-.082.215-.125.521-.125 1.064v1.345c0 .173.02.429.056.597.036.162.101.312.193.447.087.127.214.23.374.305.164.076.358.115.576.115.223 0 .409-.039.551-.113a.926.926 0 0 0 .354-.342c.098-.158.161-.309.187-.445.028-.143.042-.355.042-.631v-.205h-.796v.472c0 .25-.017.413-.052.511a.314.314 0 0 1-.309.211.278.278 0 0 1-.274-.179c-.022-.054-.047-.151-.047-.452v-.976h.002v-.001zm0-.615v-.495c0-.364.019-.309.035-.358.038-.117.141-.186.284-.186.128 0 .226.075.265.203.016.052.036.002.036.341v.634h-.619l-.001-.139z">
												</path>
											</svg>
										</a>
									</noindex>
								</li>
							</ul>

							<?php
								global $wp_query;
								$pagename = $wp_query->get( 'pagename' );
								$is_cities =
									!in_array( $pagename, [ 'politika-konfidentsialnosti', 'liability' ] );
								if( $is_cities ) { ?>
									<div class="wt-header-cities">
										<span>Ваш город:</span> <a href="#" class="wt-cities-name city-change-open">
											<?php bloginfo(); ?>
										</a>
										<?php get_template_part( 'parts/dropdown-cities' ); ?>
									</div>
								<?php } ?>
						</div>
					<?php } ?>

				</div>
			</div>
		</div>

		<div class="wt-header-navigation">
			<div class="container">
				<div class="wt-header-wrap">
					<div class="wt-burger wt-sidenav-open hidden-desktop">
						<div class="wt-burger-icon">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/svg/menu.svg"
									alt="Адаптивное меню">
						</div>
						<div class="wt-burger-text"><?php _e( 'Menu', 'walnut' ); ?></div>
					</div>
					<nav class="hidden-touch">
						<?php wt_nav_menu( 'header_menu' ); ?>
						<div class="find-block">
							<div class="wt-search-form wt-search-form-header"><?php wt_form_search(); ?></div>
						</div>
					</nav>
					<?php if( $phone && $phone[ 'href' ] ) { ?>
						<div class="wt-header-number hidden-desktop">
							<a href="<?php echo $phone[ 'href' ]; ?>" <?php echo $phone[ 'target' ] ? 'target="_blank"'
								: ''; ?> class="me_phone">
								<?php echo $phone[ 'title' ]; ?>
							</a>
						</div>
						<ul id="menu-nested-pages-mob" class="menu hidden-desktop">
							<li id="menu-item-1856" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1856">
								<a href="#">&nbsp;</a>
							</li>
						</ul>
						<div class="find-block-mob hidden-desktop">
							<div class="wt-search-form wt-search-form-header"><?php wt_form_search(); ?></div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>

	</header>

	<div class="wt-sticky">
		<div class="container">
			<div class="wt-header-wrap">
				<div class="wt-burger wt-sidenav-open hidden-desktop">
					<div class="wt-burger-icon">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/svg/menu.svg" alt="Адаптивное меню">
					</div>
					<div class="wt-burger-text"><?php _e( 'Menu', 'walnut' ); ?></div>
				</div>
				<?php if( wt_logo( 'header_logo', true ) ) { ?>
					<div class="wt-sticky-logo">
						<?php
							echo $_SERVER[ 'REQUEST_URI' ] != '/' ? '<a href="' . esc_url( home_url() ) .
								'" rel="home">' : '';
							echo wt_logo( 'footer_logo' );
							echo $_SERVER[ 'REQUEST_URI' ] != '/' ? '</a>' : '';
						?>
					</div>
				<?php } ?>
				<div class="wt-sticky-navigation hidden-touch">
					<nav><?php wt_nav_menu( 'header_menu' ); ?></nav>
				</div>
				<?php if( $phone && $phone[ 'href' ] ) { ?>
					<div class="wt-sticky-number hidden-desktop">
						<a href="<?php echo $phone[ 'href' ]; ?>" <?php echo $phone[ 'target' ] ? 'target="_blank"'
							: ''; ?> class="me_phone">
							<?php echo $phone[ 'title' ]; ?>
						</a>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>

	<div class="wt-main">

		<?php wm_header_blocks(); ?>

		<main class="wt-page">
