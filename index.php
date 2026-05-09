<?php
/**
 * The site's entry point.
 *
 * Loads the relevant template part,
 * the loop is executed (when needed) by the relevant template part.
 *
 * @package HelloElementor
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();

// $is_elementor_theme_exist = function_exists( 'elementor_theme_do_location' );

global $flowyth_dir;

$flowyth_dir = get_template_directory_uri();


global $post;

?>

<main id="theme-content">
	<div class="content-wrap"><?php
if ( is_front_page() && is_home() ) {
  // HOME PAGE IS SET TO LATEST POST
	get_template_part( 'template-parts/home' );
}
else if (is_home()) {
	$blog_page_id = get_option('page_for_posts');
	get_template_part( 'template-parts/archive' );
}
else if ( is_singular() ) {
	$front_page_id = get_option('page_on_front');

	if ($front_page_id == $post->ID) {
		get_template_part( 'template-parts/home' );
	}
	else {
		get_template_part( 'template-parts/single' );
	}
	
}
elseif ( is_archive() ) {
	get_template_part( 'template-parts/archive' );
}
elseif ( is_search() ) {
	get_template_part( 'template-parts/search' );
}
else {
	get_template_part( 'template-parts/404' );
}
?>
	</div>
</main><!-- .main --><?php

get_footer();
