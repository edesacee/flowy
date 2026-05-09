<?php

$logo_id = get_theme_mod('custom_logo2');
$flowy_dir = get_stylesheet_directory_uri();
$custom_logo_id   = get_theme_mod( 'custom_logo' );

?>
<header id="theme-header">
	<div class="container-flex">
		<div class="logo">
			<?php 
				if (!$custom_logo_id) {
					echo '<a href="' . get_bloginfo('wpurl') . '/wp-admin/customize.php"><img src="' . $flowy_dir . '/images/flowy-logo.png" alt="Powered By Flowy Theme" style="height: 45px" /></a>';
				}
				else {
					echo get_custom_logo();
				}
			?>
		</div>
		<div class="center-nav">
			<div class="desktop-menu">
				<?php wp_nav_menu(array('theme_location' => 'header-menu')); ?>
			</div>
			<div class="mobile-menu">
				<span style="font-size:30px; cursor:pointer; margin-right: 10px;" onclick="openNav()"><i class="fa-solid fa-bars"></i></span>
				<div class="side-menu">
					<div class="inner">
						<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
						<div class="logo"><?php echo get_custom_logo(); ?></div>
						<?php wp_nav_menu(array('theme_location' => 'header-menu')); ?>
					</div>
				</div>
			</div>
		</div>
		
		<?php

		if ( class_exists( 'WooCommerce' ) ) { 
			$cart_url = wc_get_cart_url();
			$my_account_url = get_permalink( wc_get_page_id( 'myaccount' ) );
		?>
		<div class="right-nav">
			<ul>
				<li><a href="<?php echo $my_account_url ?>"><i class="fa-solid fa-user"></i></a></li>
				<li><a href="<?php echo $cart_url  ?>"><i class="fa-solid fa-cart-arrow-down"></i></a></li>
			</ul>
		</div><?php
		} ?>
			
	</div>
</header>