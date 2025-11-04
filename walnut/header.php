<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<title><?php wp_title(); ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="theme-color" content="#cccccc">

		<?php $favicon = wt_get_favicon(); ?>
		<?php if( $favicon ) { ?>
			<link rel="shortcut icon" href="<?php echo $favicon['url']; ?>">
		<?php } ?>

		<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>">

		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>

		<header class="site-header">

			<div class="site-header-top">
				<div class="container">

					<?php if( ! wt_is_desktop() ) { ?>
						<div class="site-menu side-menu-open">
							<div class="site-menu-icon"><img src="<?php echo  get_template_directory_uri(); ?>/img/svg/menu.svg"></div>
							<div class="site-menu-text"><?php _e( 'Menu', 'walnut' ); ?></div>
						</div>
					<?php } ?>

					<?php wt_is_not_phone() && wt_social_links(); ?>

				</div>
			</div>

			<div class="site-header-main">
				<div class="container">

					<div class="site-row-table">

						<?php $description = get_bloginfo( 'description', 'display' ); ?>
						<div class="site-brand
							<?php echo ! $description || ! get_city_name() ? 'site-brand-half' : 'site-brand-full'; ?>">
							<a href="<?php echo esc_url( home_url() ); ?>" class="site-logo" rel="home">
								<?php echo wt_logo(); ?>
							</a>
							<?php if( get_city_name() && $description ) { ?>
								<div class="site-name">
									<?php if( is_front_page() ) { ?>
										<p class="site-name-title">
											<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
												<?php the_city_name() ?>
											</a>
										</p>
									<?php } else { ?>
										<p class="site-name-title">
											<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
												<?php the_city_name() ?>
											</a>
										</p>
									<?php } ?>
									<?php if( $description || is_customize_preview() ) { ?>
										<p class="site-name-description"><?php echo $description; ?></p>
									<?php } ?>
								</div>
							<?php } ?>
						</div>

						<?php if( wt_is_desktop() ) { ?>
							<div class="site-address hidden-touch">
								<p class="site-address-destination"><?php echo wt_options( 'address' ); ?></p>
								<p class="site-address-distance"><?php echo wt_options( 'distance' ); ?></p>
								<p class="site-address-worktime"><?php echo wt_options( 'worktime' ); ?></p>
							</div>
						<?php } ?>

						<?php if( wt_is_not_phone() ) { ?>
							<div class="site-contacts hidden-mobile">
								<?php $phone = wt_options( 'phone' ); ?>
								<p class="site-contacts-phone">
									<a href="<?php echo $phone['href']; ?>" <?php echo $phone['target'] ? 'target="_blank"' : ''; ?>>
										<?php echo $phone['title']; ?>
									</a>
								</p>
								<?php $email = wt_options( 'email' ); ?>
								<p class="site-contacts-email">
									<a href="<?php echo $email['href']; ?>" <?php echo $email['target'] ? 'target="_blank"' : ''; ?>>
										<?php echo $email['title']; ?>
									</a>
								</p>
								<div class="site-callback">
									<a href="#" class="btn btn-main modal-widget-open">
										<?php _e( 'Get in touch', 'walnut' ); ?>
									</a>
								</div>
							</div>
						<?php } ?>

					</div>

				</div>
			</div>

			<?php if( wt_is_desktop() ) { ?>
				<div class="site-header-navigation">
					<div class="container">

						<nav role="navigation"><?php wt_nav_menu( 'header_menu' ); ?></nav>

					</div>
				</div>
			<?php } ?>

		</header>

		<div class="site-page">
