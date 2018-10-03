<?php
/**
 * Template for displaying search forms in Twenty Seventeen
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */
?>

<?php $unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<!--label for="<?php echo $unique_id; ?>">
		<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'twentyseventeen' ); ?></span>
	</label-->
	<input type="search" id="<?php echo $unique_id; ?>" class="srch1" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder', 'twentyseventeen' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="btn btn-info srech-t"> <i class="icon-search"></i> </button>
</form>
