<?php
$obj = get_queried_object();
?>
<a href="<?php the_permalink(); ?>" class="wt-category-item">
	<div class="wt-category-thumbnail"><?php wm_usability( 'image' ) && the_post_thumbnail( 'adaptive' ); ?></div>
	<div class="wt-category-content">
		<?php if( wm_usability( 'name' ) ) { ?>
			<h2 class="wt-category-content-name" <?php echo ($obj->slug == 'blog') ? 'itemprop="headline"' : ''; ?>><?php wm_post_name(); ?></h2>
		<?php } ?>
		
		<?php if (get_field('цена')) {?>
			<div style="font-weight: bold;"><u>От <?php echo get_field('цена');?> руб.</u></div>
		<?php } ?>

		<?php if( wm_usability( 'date' ) ) { ?>
			<div class="wt-category-content-date"><?php the_time( 'j F Y' ); ?> года</div>
		<?php } ?>
		<?php if( wm_usability( 'desc' ) ) { ?>
			<p class="wt-category-content-excerpt" <?php echo ($obj->slug == 'blog') ? 'itemprop="description"' : ''; ?>><?php the_excerpt(); ?></p>
		<?php } ?>
	</div>
</a>