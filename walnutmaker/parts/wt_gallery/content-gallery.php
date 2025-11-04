<?php if( have_posts() ) { ?>
	
	<ul class="wt-gallery-photos-row content-left">
		
		<?php while( have_posts() ) { ?>
			<?php the_post(); ?>
			<li class="gallery-col col-sm-6 col-md-3">
				<a data-fancybox="gallery" href="<?php the_post_thumbnail_url( 'full' ); ?>">
					<?php the_post_thumbnail( 'adaptive' ); ?>
				</a>
			</li>
		<?php } ?>
	
	</ul>

<?php } ?>