<?php if( have_posts() ) { ?>
	
	<ul class="gallery-list list-left">
		
		<?php while( have_posts() ) { ?>
			<?php the_post(); ?>
			<li class="gallery-col col-small-6 col-medium-3">
				<a href="<?php the_permalink(); ?>" class="gallery-item">
					<?php the_post_thumbnail( 'adaptive' ); ?>
					<?php wt_rating_block( true ); ?>
					<div class="gallery-item-name"><?php the_title(); ?></div>
				</a>
			</li>
		<?php } ?>
	
	</ul>

<?php } ?>