<?php
	//avoid direct calls to this file where wp core files not present
	if( ! function_exists( 'add_action' ) ) {
		header( 'Status: 403 Forbidden' );
		header( 'HTTP/1.1 403 Forbidden' );
		exit();
	}

	/**
	 * Custom walker for switching checkbox inputs to radio.
	 *
	 * @see Walker_Category_Checklist
	 */
	class WT_Tax_Radio_Checklist extends Walker_Category_Checklist {
		function walk( $elements, $max_depth, $args = array() ) {
			$output = parent::walk( $elements, $max_depth, $args );
			$output = str_replace( array( 'type="checkbox"', "type='checkbox'" ), array(
					'type="radio"',
					"type='radio'"
				), $output );

			return $output;
		}
	}