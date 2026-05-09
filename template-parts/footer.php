<?php

$fb_url =  get_theme_mod('facebook');
$insta_url = get_theme_mod('instagram');
$yt_url =  get_theme_mod('youtube');
$pinterest_url =  get_theme_mod('pinterest');
$twitter_url =  get_theme_mod('twitter');
$tiktok_url =  get_theme_mod('tiktok');

$company_name = get_theme_mod('flowy_footer_company_name', 'Company Name');
$company_details = get_theme_mod('flowy_footer_company_description', '{enter address or company details}');

?>
<footer id="theme-footer">
	<div class="container-flex col-three">
		<div class="contact col">
			<h2><?php echo $company_name ?></h2>
			<div><?php echo $company_details ?></div>
		</div>			
		<div class="nav about col">
			<h2>About</h2>
			<?php wp_nav_menu(array('theme_location' => 'footer-menu-1')); ?>
		</div>
		<div class="nav what-we-do col">
			<h2>What We Do</h2>
			<?php wp_nav_menu(array('theme_location' => 'footer-menu-2')); ?>
		</div>					
	</div>
	<div class="container bottom-footer">
		<div class="social-links">
			<span class="follow-us">Follow Us!</span>
			<?php echo get_theme_mod('enable_instagram') && $insta_url ?  '<a target="_blank" href="' . $insta_url . '"><i class="fas fa-brands fa-instagram"></i></a>' : ''; ?>
			<?php echo get_theme_mod('enable_facebook') && $fb_url ?  '<a target="_blank" href="' . $fb_url . '"><i class="fas fa-brands fa-square-facebook"></i></a>' : ''; ?>
			<?php echo get_theme_mod('enable_tiktok') && $tiktok_url ?  '<a target="_blank" href="' . $tiktok_url . '"><i class="fa fa-brands fa-tiktok"></i></a>' : ''; ?>
			<?php echo get_theme_mod('enable_youtube') && $yt_url ?  '<a href="' . $yt_url . '"><i class="fa fa-brands fa-youtube"></i></a>' : ''; ?>
			<?php echo get_theme_mod('enable_pinterest') && $pinterest_url ?  '<a target="_blank" href="' . $pinterest_url . '"><i class="fa fa-brands fa-pinterest"></i></a>' : ''; ?>
			<?php echo get_theme_mod('enable_twitter') && $twitter_url ?  '<a target="_blank" href="' . $twitter_url . '"><i class="fa fa-brands fa-twitter"></i></a>' : ''; ?>
		</div>		
	</div>
</footer>
<?php