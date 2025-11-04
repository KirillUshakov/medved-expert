<?php /** Template Name: Контакты */ ?>
<?php get_header(); ?>

	<div class="wt-page-head">
		<div class="container">
			<div class="wt-page-breadcrumbs hidden-xs">
				<?php wt_breadcrumbs(); ?>
			</div>
			<div class="wt-page-title test4">
				<h1>
					<?php the_title(); ?>
					<?php add_city_postfix() ?>
				</h1>
			</div>
		</div>
	</div>

	<div class="container clearfix">

		<div class="wt-contacts">
			<?php the_post(); ?>

			<div class="page-content">
				<?php the_content(); ?>

				<div class="wt-page-row" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">

					<?php if( get_field( 'zip' ) || get_field( 'city' ) || get_field( 'street' ) ||
						get_field( 'desc' ) ) { ?>
						<div class="wt-page-col col-md-4">
							<ul class="wt-contacts-block wt-contacts-block-address">
								<meta itemprop="name" content="<?php bloginfo(); ?>">
								<li>
									<div class="wt-contacts-label">Адрес</div>
									<?php
										if( get_field( 'zip' ) ) {
											echo '<span itemprop="postalCode">' . get_field( 'zip' ) . '</span>';
										}
										if( get_field( 'city' ) ) {
											echo ', <span itemprop="addressLocality">' . get_field( 'city' ) .
												'</span>';
										}
										if( get_field( 'street' ) ) {
											echo ', <span itemprop="streetAddress">' . get_field( 'street' ) . '</span>';
										}
										if( get_field( 'desc' ) ) {
											echo ', <span>' . get_field( 'desc' ) . '</span>';
										}
									?>
								</li>
							</ul>
						</div>
					<?php } ?>

					<?php $phone = wt_options( 'phone' ); ?>
					<?php $phone_add = wt_options( 'phone_add' ); ?>
					<?php if( $phone || $phone_add ) { ?>
						<div class="wt-page-col col-md-4">
							<ul class="wt-contacts-block wt-contacts-block-phones">
								<?php if( $phone ) { ?>
									<li>
										<div class="wt-contacts-label">Телефон</div>
										<a href="<?php echo $phone[ 'href' ]; ?>"<?php echo $phone[ 'target' ]
											? ' target="_blank"' : ''; ?> itemprop="telephone" class="me_phone">
											<?php echo $phone[ 'title' ]; ?>
										</a>
									</li>
								<?php } ?>
								<?php if( $phone_add && $phone_add[ 'href' ] ) { ?>
									<li>
										<div class="wt-contacts-label">Дополнительный телефон</div>
										<a href="<?php echo $phone_add[ 'href' ]; ?>"<?php echo $phone_add[ 'target' ]
											? ' target="_blank"' : ''; ?>><?php echo $phone_add[ 'title' ]; ?></a>
									</li>
								<?php } ?>
							</ul>
						</div>
					<?php } ?>

					<?php $email = wt_options( 'email' ); ?>
					<?php if( $email ) { ?>
						<div class="wt-page-col col-md-4">
							<ul class="wt-contacts-block wt-contacts-block-mail">
								<li>
									<div class="wt-contacts-label">Электронная почта</div>
									<a href="<?php echo $email[ 'href' ]; ?>"<?php echo $email[ 'target' ]
										? ' target="_blank"' : ''; ?>><?php echo $email[ 'title' ]; ?></a>
								</li>
							</ul>
						</div>
					<?php } ?>

				</div>
			</div>
			<?php wm_content_blocks(); ?>
		</div>

	</div>

<?php get_footer(); ?>
