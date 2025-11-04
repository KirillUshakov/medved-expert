<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title><?php bloginfo( 'name' ); ?><?php wp_title(); ?></title>
		<link href='https://fonts.googleapis.com/css?family=Neucha&subset=cyrillic' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/404.css">
	</head>
	<body>

		<div class="lost">

			<div>

				<img src="<?php echo get_template_directory_uri(); ?>/img/404/404.svg">

				<h1><?php _ex( 'Oops!', 'Title of 404 page', 'walnut' ); ?></h1>

				<p><?php echo sprintf( _x( 'It seems, you are lost! Go to the %shome page%s. ',
						'Text with link on 404 page', 'walnut' ), '<a href="/">', '</a>' ); ?></p>

			</div>

		</div>

	</body>
</html>