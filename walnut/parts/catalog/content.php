<?php if( have_posts() ) { ?>
	
	<?php while( have_posts() ) { ?>
		<?php the_post(); ?>
		
		<div>
			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			
			<a href="<?php the_permalink(); ?> "><?php the_post_thumbnail(); ?></a>
			<?php the_excerpt(); ?>
		</div>
	
	<?php } ?>

<?php } else { ?>
	<p><?php _e( 'Sorry, no posts matched your criteria.', 'walnut' ); ?></p>
<?php } ?>