<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <div>
		<input type="text" id="search__input" placeholder="<?php _ex( 'Site search', 'Placeholder on form of search', 'walnut' ); ?>" name="s" id="s" value="<?php echo get_search_query(); ?>" />
		<input type="submit" id="searchsubmit" value="<?php echo esc_attr_x( 'Search', 'submit button' ); ?>" />
    </div>
</form>