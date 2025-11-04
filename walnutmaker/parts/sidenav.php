<div class="wt-sidenav wt-sidenav-left">
	<div class="wt-sidenav-icon">
		<a href="#" class="wt-sidenav-close"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/svg/close.svg"
					alt="Закрыть адаптивное меню">
			<span class="screen-reader-text">Закрыть</span></a>
	</div>
	<div class="wt-sidenav-brand">
		<div class="wt-sidenav-logo">
			<?php
				echo $_SERVER[ 'REQUEST_URI' ] != '/' ? '<a href="' . esc_url( home_url() ) . '" rel="home">' : '';
				echo wt_logo();
				echo $_SERVER[ 'REQUEST_URI' ] != '/' ? '</a>' : '';
			?>
		</div>
	</div>
	<div class="wt-sidenav-navigation">
		<?php wt_nav_menu( 'header_menu' ); ?>
	</div>
	<?php /* ?>
	<ul class="wt-sidenav-policy">
		<li><a href="https://medved-expert.ru/politika-konfidentsialnosti/" target="_blank">Политика
				конфиденциальности</a></li>
		<li><a href="https://medved-expert.ru/liability/" target="_blank">Ограничение ответственности</a></li>
	</ul>
	<?php */ ?>
</div>

<div class="wt-sidenav-overlay"></div>