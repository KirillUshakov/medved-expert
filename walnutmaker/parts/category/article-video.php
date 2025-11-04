<a href="<?php the_field( 'video' ); ?>" class="wt-category-item wt-category-item-video" data-fancybox>
	<div class="wt-category-thumbnail"><?php wm_usability( 'image' ) && the_post_thumbnail( 'adaptive' ); ?></div>
	<div class="wt-category-content">
		<?php if( wm_usability( 'name' ) ) { ?>
			<h3 class="wt-category-content-name"><?php wm_post_name(); ?></h3>
		<?php } ?>
		<?php if( wm_usability( 'date' ) ) { ?>
			<div class="wt-category-content-date"><?php the_time( 'd.m.Y' ); ?></div>
		<?php } ?>
		<?php if( wm_usability( 'desc' ) ) { ?>
			<p class="wt-category-content-excerpt"><?php the_excerpt(); ?></p>
		<?php } ?>
	</div>
</a>