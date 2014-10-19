<?php
/**
 * The template for displaying search forms in FlatMarket
 *
 * @package FlatMarket
 */
?>
	<form method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		<input type="search" class="field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'flatmarket' ); ?>" />
		<input type="submit" class="submit btn" id="searchsubmit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'flatmarket' ); ?>" />
	</form>
