<?php
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$posts_per_page = get_option('posts_per_page');

$args = array(
    'post_type' => 'post', // Specifies the post type (e.g., 'post', 'page', 'custom_post_type')
    'posts_per_page' => $posts_per_page, // Number of posts to retrieve
    'paged' => $paged,
    'order' => 'DESC', // Order of posts (ASC or DESC)
    'orderby' => 'date' // Field to order by (e.g., 'date', 'title', 'rand')
);

$custom_query = new WP_Query($args);
$count = $custom_query->found_posts;
$blog_page = get_option('page_for_posts');
$permalink = get_permalink($blog_page);
?>


<?php // if ( apply_filters( 'hello_elementor_page_title', true ) ) : ?>
    <!--<div class="page-header">
        <h1><?php echo get_the_title($blog_page) ?></h1>
    </div>-->
<?php // endif; ?>

<div class="page-content archive"><?php

if ($custom_query->have_posts()) :
    while ($custom_query->have_posts()) : $custom_query->the_post();
        // Display post content here
        $post_id = get_the_ID();
        ?>
        <div class="item">
            <div class="container-flex">
                <div class="col">
                    <?php echo get_the_post_thumbnail( $post_id, 'flowyth_blog_thumbnail', array( 'class' => 'alignleft' ) ); ?>
                </div>
                <div class="col">
                    <?php the_title('<h2 class="title"><a href="' . get_the_permalink() . '">', '</a></h2>'); ?>
                    <div class="excerpt">
                    <?php
                        the_excerpt();
                        
                    ?>
                    </div>
                    <?php echo '<div class="details"><a href="' . get_the_permalink() . '" class="read-more">Read More</a></div>'; ?>
                </div>
            </div>
        </div>
        <?php
    endwhile;
    wp_reset_postdata(); // Restore original post data

    echo flowythGetPagination($permalink, $count, $posts_per_page, $paged);
else :
    echo 'No posts found.';
endif;
?>
</div>

<?php // comments_template(); ?>