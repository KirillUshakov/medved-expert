<?php if( have_posts() ) { ?>
	
	<ul class="wt-gallery-photos-row">
		
		<?php while( have_posts() ) { ?>
			<?php the_post(); ?>
			<li class="wt-gallery-photos-col col-sm-6 col-md-3">
				<a href="<?php the_permalink(); ?>">
					<div class="wt-gallery-photos-thumb"><?php the_post_thumbnail( 'adaptive' ); ?></div>
				</a>
			</li>
		<?php } ?>
	
	</ul>

<?php } ?>