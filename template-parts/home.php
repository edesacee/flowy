<?php
global $flowyth_dir, $post;

$theme_slug = get_stylesheet();
$enable_intro = get_theme_mod('flowy_enable_introduction', true);
$intro_title = get_theme_mod('flowy_intro_title', FLOWY_DEFAULT_TITLE);
$intro_subtitle = get_theme_mod('flowy_intro_subtitle', FLOWY_DEFAULT_SUBTITLE);
$intro_content = get_theme_mod('flowy_intro_paragraph', FLOWY_DEFAULT_PARAGRAPH);

if (function_exists('wc_get_page_permalink')) {
    $shop_url = wc_get_page_permalink( 'shop' );    
}
else {
    $shop_url = '';
}

$read_more_url = get_bloginfo('wpurl');

$intro_shop_url = get_theme_mod('flowy_intro_shop_url', $shop_url);
$intro_read_more_url = get_theme_mod('flowy_intro_read_more_url', $read_more_url);
$intro_feat_image_id = get_theme_mod('flowy_intro_image');

if ($intro_feat_image_id) {
	$intro_feat_image = wp_get_attachment_image_url($intro_feat_image_id, 'large');
}
else {
	$intro_feat_image = get_bloginfo('wpurl') . '/wp-content/themes/' . $theme_slug . '/images/web-dev-office.webp';
}
$intro_image_alt_text = get_theme_mod('flowy_intro_image_alt', $intro_title);

if ($enable_intro) {
?>
<div id="row-one">
	<div class="container-flex">
		<div class="left-pane">
			<div class="inner">
				<h1><?php echo $intro_title ?></h1>
				<h2><?php echo $intro_subtitle ?></h2>
				<p><?php echo $intro_content ?></p>
				<div class="buttons">
					<?php
					if ($intro_shop_url) {
						echo '<a href="' . $intro_shop_url . '" class="btn">Shop</a>';
					}

					if ($intro_read_more_url) {
						echo '<a href="' . $intro_read_more_url . '" class="btn">Read More</a>';
					}				
					?>
				</div>
			</div>
		</div>
		<div class="right-pane">
			<img src="<?php echo $intro_feat_image ?>" alt="<?php echo $intro_image_alt_text ?>" class="block-img" />
		</div>
	</div>
</div><?php
} // INTRODUCTION

$enable_counters = get_theme_mod('flowy_enable_counters', true);

if ($enable_counters) {
    $counter_label1 = get_theme_mod('flowy_counter_label1', 'Sold This Month');
    $counter_value1 = get_theme_mod('flowy_counter_value1', '3000+');

    $counter_label2 = get_theme_mod('flowy_counter_label2', '5 Star Rating');
    $counter_value2 = get_theme_mod('flowy_counter_value2', '1000+');

    $counter_label3 =  get_theme_mod('flowy_counter_label3', 'Repeat Customers');
    $counter_value3 = get_theme_mod('flowy_counter_value3', '500+');

    $counter_label4 = get_theme_mod('flowy_counter_label4', 'Years of Experience');
    $counter_value4 = get_theme_mod('flowy_counter_value4', '7+');	

    $counter_label5 = get_theme_mod('flowy_counter_label5', '');
    $counter_value5 = get_theme_mod('flowy_counter_value5', '');	    
?>
<div id="row-two">
	<div class="container-flex col-four"><?php
    if ($counter_label1 && $counter_value1) { ?>
		<div class="col">
			<div class="ctr"><?php echo $counter_value1 ?></div>
			<div class="name"><?php echo $counter_label1 ?></div>
		</div><?php
	}

	if ($counter_label2 && $counter_value2) { ?>
		<div class="col">
			<div class="ctr"><?php echo $counter_value2 ?></div>
			<div class="name"><?php echo $counter_label2 ?></div>			
		</div><?php
	}
	
	if ($counter_label3 && $counter_value3) { ?>
		<div class="col">
			<div class="ctr"><?php echo $counter_value3 ?></div>
			<div class="name"><?php echo $counter_label3 ?></div>			
		</div><?php
	}
	
	if ($counter_label4 && $counter_value4) { ?>
		<div class="col">
			<div class="ctr"><?php echo $counter_value4 ?></div>
			<div class="name"><?php echo $counter_label4 ?></div>			
		</div><?php
	}

	if ($counter_label5 && $counter_value5) { ?>
		<div class="col">
			<div class="ctr"><?php echo $counter_value5 ?></div>
			<div class="name"><?php echo $counter_label5 ?></div>			
		</div><?php
	} ?>
	</div>
</div>
<?php
} // COUNTERS

$front_page_id = get_option('page_on_front');

if ($post->post_type == 'page' && $front_page_id) {
	$post_id = $front_page_id;
	$post_object = get_post($post_id);
	$raw_content = $post_object->post_content;

	if ($raw_content) {
	?>
<div id="row-content">
	<div class="container"><?php

	// Apply all 'the_content' filters
	$filtered_content = apply_filters('the_content', $raw_content);
	echo $filtered_content;

	?>
	</div>
</div><?php
	}
}

if (class_exists( 'WooCommerce')) {
	$enable_featproducts = get_theme_mod('flowy_enable_featproducts', true); 

	if ($enable_featproducts) {
        $title = get_theme_mod('flowy_featproducts_title', FLOWY_DEFAULT_TITLE);
        $subtitle = get_theme_mod('flowy_featproducts_subtitle', FLOWY_DEFAULT_SUBTITLE);
        $product_ids = trim(get_theme_mod('flowy_featproducts_ids', ''));

        if ($product_ids) {
        	$arr_prod_ids = explode(',', $product_ids);

        	if (is_array($arr_prod_ids)) {
?>	
<div id="row-three">
	<div class="container">
		<?php echo $title ? '<h2 class="section-header">' . $title . '</h2>' : ''; ?>
		<?php echo $subtitle ? '<h3 class="section-subheader">' . $subtitle . '</h3>' : ''; ?>
		<div class="inner-container-flex featured-products"><?php
			foreach($arr_prod_ids as $pid) {
				$prod_id = trim($pid);
				$product = wc_get_product($prod_id);

				if ( $product ) {
				    $short_desc = $product->get_short_description(); // Get short descriptio		

				    if (!$short_desc) {
				    	$short_desc = wp_trim_words($product->get_description(), 15, '...');
				    }
			?>
			<div class="col">
				<div class="box">
					<?php echo wp_get_attachment_image(get_post_thumbnail_id($prod_id), 'flowyth_big_thumbnail') ?>
					<div class="inner">
						<h3><?php echo $product->get_name() ?></h3>
						<p><?php echo $short_desc ?></p>
						<a href="<?php echo get_permalink($prod_id) ?>" class="btn">Read More</a>
					</div>
				</div>
			</div><?php
				}
			} ?>
		</div>
	</div>
</div><?php
			}
		}
	}
}

$enable_special_offer = get_theme_mod('flowy_enable_special_offer', true);

if ($enable_special_offer) {
    $title  = get_theme_mod('flowy_special_offer_title', 'Special Offer');
    $content = get_theme_mod('flowy_special_offer_content', '20%');
    $subtitle = get_theme_mod('flowy_special_offer_subtitle', 'For the first 20 customers.');	
    $image_id = get_theme_mod('flowy_special_offer_image');

	if ($image_id) {
		$image_url = wp_get_attachment_image_url($image_id, 'large');
	}
	else {
		$image_url = get_bloginfo('wpurl') . '/wp-content/themes/' . $theme_slug . '/images/work-from-home.jpg';
	}

    $image_alt = get_theme_mod('flowy_special_offer_image_alt', 'Special Offer');
?>
<div id="row-five">
	<div class="container-flex">
		<div class="left-pane">
			<div class="special-offer">
				<?php echo $title ? '<h2><span>' . $title . '</spam></h2>' : '' ?>
				<?php echo $content ? '<h3>' . $content . '</h3>' : '' ?>
				<?php echo $subtitle ? '<p>' . $subtitle . '</p>' : '' ?>
			</div>
		</div>
		<div class="right-pane"><img src="<?php echo $image_url ?>" alt="<?php echo $image_alt ?>" class="block-img" /></div>
	</div>
</div><?php
} ?>
<!--<div id="row-six">
	<div class="container-flex">
		<div class="left-pane">
			<img src="<?php echo $flowyth_dir ?>/images/we-select-best-flowers.jpg" alt="Flower Arrangements" class="block-img" />
		</div>
		<div class="right-pane">
			<h2 class="subheader">We select the best flowers</h2>
			<p>Donec faucibus purus consectetur ante pulvinar, eu sodales justo varius. Nullam iaculis augue eu dui venenatis mattis.</p>
			<div class="read-more"><a href="#">Read More</a></div>
		</div>
	</div>
</div>-->
<!--<div id="row-seven">
	<div class="container-flex">
		<div class="left-pane">
			<h2 class="subheader">We take care of the details</h2>
			<p>Donec faucibus purus consectetur ante pulvinar, eu sodales justo varius. Nullam iaculis augue eu dui venenatis mattis.</p>			
			<div class="read-more"><a href="#">Read More</a></div>
		</div>
		<div class="right-pane">
			<img src="<?php echo $flowyth_dir ?>/images/we-take-care-of-details.jpg" alt="We take care of the details" class="block-img" />
		</div>
	</div>
</div>-->
<?php

$enable_contact_section  = get_theme_mod('flowy_enable_contact_section', true);

if ($enable_contact_section) {
	$title  = get_theme_mod('flowy_contact_title', FLOWY_DEFAULT_TITLE);
	$subtitle  = get_theme_mod('flowy_contact_subtitle', FLOWY_DEFAULT_SUBTITLE);
	$content  = get_theme_mod('flowy_contact_content', 'Enter Contact Form 7 Shortcode');	
?>
<div id="row-seven">
	<div class="container">
		<?php echo $title ? '<h2 class="section-header">' . $title . '</h2>' : '' ?>
		<?php echo $subtitle ? '<h3 class="section-subheader">' . $subtitle . '</h3>' : '' ?>
		<?php echo $content ? do_shortcode($content) : '' ?>
	</div>
</div><?php
}