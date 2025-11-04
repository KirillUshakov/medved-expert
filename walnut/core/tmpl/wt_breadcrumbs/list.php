<?php
	if( isset( $data ) && $data && isset( $data[ 'breadcrumbs' ] ) && $data[ 'breadcrumbs' ] ) {
		$breadcrumbs = $data[ 'breadcrumbs' ];
		$count = count( $breadcrumbs );
		$i = 0;
		?>
		<ul <?php echo $data[ 'class' ] ? 'class="' . $data[ 'class' ] . '"' : ''; ?>itemscope
				itemtype="https://schema.org/BreadcrumbList">
			<?php foreach( $breadcrumbs as $breadcrumb ) { ?>
				<li<?php echo $data[ 'class' ] ? ' class="' . $data[ 'class' ] . '-item"' : ''; ?>
						itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
					<a href="<?php echo $breadcrumb->link; ?>" itemprop="item"><span
								itemprop="name"><?php echo $breadcrumb->text; ?></span></a>
					<meta itemprop="position" content="<?php echo $i + 1; ?>"/>
				</li>
				<?php if( isset( $data[ 'separator' ] ) && $data[ 'separator' ] && $i != $count - 1 ) { ?>
					<li<?php echo $data[ 'class' ] ? ' class="' . $data[ 'class' ] . '-separator"' : ''; ?>>
						<span></span>
					</li>
				<?php } ?>
				<?php $i++; ?>
			<?php } ?>
		</ul>
	<?php } ?>