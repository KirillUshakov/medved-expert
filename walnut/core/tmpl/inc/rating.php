<div class="wt-rating" data-post-id="<?php echo $post_id; ?>" itemprop="aggregateRating" itemscope
	 itemtype="http://schema.org/AggregateRating">
	<?php for( $i = 1;$i < 6;$i++ ) { ?>
		<label class="wt-rating-item <?php echo isset( $rating_average ) && $rating_average >= $i ? 'wt-rating-checked' :
			''; ?> <?php echo ( !isset( $disable ) || !$disable ) && isset( $rating ) && $rating >= $i ?
			'wt-rating-active' : ''; ?>">
			<input type="radio" name="rating-<?php echo $post_id; ?>"
				   value="<?php echo $i; ?>"<?php echo isset( $rating ) && $rating == $i ? ' checked' : '';
				echo isset( $disable ) && $disable ? ' disabled' : ''; ?>>
		</label>
	<?php } ?>
	<?php if( isset( $rating_average ) && isset( $rating_count ) ) { ?>
		<meta itemprop="itemReviewed" content="<?php the_title(); ?>">
		<meta itemprop="ratingValue" content="<?php echo floor( $rating_average ); ?>">
		<meta itemprop="worstRating" content="0">
		<meta itemprop="bestRating" content="5">
		<meta itemprop="ratingCount" content="<?php echo $rating_count; ?>">
	<?php } ?>
</div>