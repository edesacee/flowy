<?php
/**
 * The template for displaying singular post-types: posts, pages and user-defined custom post types.
 *
 * @package HelloElementor
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $post;

while ( have_posts() ) :
	the_post();
	?>
	<?php // if ( apply_filters( 'hello_elementor_page_title', true ) ) : ?>
		<div class="page-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</div>
	<?php // endif; ?>

	<div class="page-content single">
		<?php 
			if ($post->post_type != 'page' && $post->post_type != 'product') {
				echo '<div class="details">Written by <span class="author">';
				the_author();
				echo '</span> in ';
				the_category(' | ');
				echo '</div>';
			}
		?>		
		<?php the_content(); ?>

		<?php wp_link_pages(); ?>

		<?php if ( has_tag() ) : ?>
		<div class="post-tags">
			<?php the_tags( '<span class="tag-links">' . esc_html__( 'Tags: ', 'flowy-theme' ), ', ', '</span>' ); ?>
		</div>
		<?php endif; ?>

		<?php

		if (comments_open()) {
			comments_template();
		} ?>		
	</div>
<?php

endwhile;
