<?php if( have_posts() ) { ?>

    <ul class="gallery-list list-left">
		
		<?php while( have_posts() ) { ?>
			<?php the_post(); ?>
            <li class="gallery-col col-small-6 col-medium-3">
                <a data-fancybox="gallery" href="<?php the_post_thumbnail_url( 'full' ); ?>">
					<?php the_post_thumbnail( 'adaptive' ); ?>
                </a>
            </li>
		<?php } ?>

    </ul>

<?php } ?>