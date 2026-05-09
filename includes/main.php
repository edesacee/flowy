<?php

class Flowyth_Main extends flowyth\Main {

    public function __construct($file, $options = array()) {
		$class_name = get_class();
		parent::__construct($file, $options);

		add_action('init', array($class_name, '__init'));
		add_action('plugins_loaded', array($class_name, '__pluginsLoaded'));

		// register_activation_hook(RNH_FILE, 'lwActivateActions');
		// register_deactivation_hook(RNH_FILE, 'lwDeactivateeActions');

		$folder = Flowyth_Main::__getPluginPath() . 'logs/';
		@mkdir($folder);

		add_action('wp_enqueue_scripts', array($class_name, 'enqueue_parent_styles'));

        add_action('after_setup_theme', array($class_name, 'register_my_menu'));

        add_image_size('flowyth_blog_thumbnail', 600, 400, true);
        add_image_size('flowyth_big_thumbnail', 400, 300, true);
	} //func:__construct

    public static function customCss() {
        $header_bg = get_theme_mod('header_bg');
        $footer_bg = get_theme_mod('footer_bg');
        $content_width = get_theme_mod('content_width');
        $menu_item_text_color = get_theme_mod('menu_item_text_color');
        $menu_item_hover_color = get_theme_mod('menu_item_hover_color');
        $menu_item_text_color2 = get_theme_mod('menu_item_text_color2');
        $menu_item_hover_color2 = get_theme_mod('menu_item_hover_color2');        
        $social_icon_color = get_theme_mod('social_icon_color');
        $social_icon_hover_color = get_theme_mod('social_icon_hover_color');

        $copyright_text_color = get_theme_mod('copyright_text_color');

        $site_name = get_bloginfo('name');
        $site_description = get_bloginfo('description');
        ?>
        <title><?php echo $site_name; ?></title>
        <meta name="description" content="<?php echo $site_description ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Barlow">
        <style type="text/css">
            :root {
              --width: <?php echo $content_width ? $content_width : '1140' ?>px;
              --menu_text_color: <?php echo $menu_item_text_color ? $menu_item_text_color : '000' ?>;
              --menu_hover_color: <?php echo $menu_item_hover_color ? $menu_item_hover_color : '#444' ?>;
              --menu_text_color2: <?php echo $menu_item_text_color2 ? $menu_item_text_color2 : '000' ?>;
              --menu_hover_color2: <?php echo $menu_item_hover_color2 ? $menu_item_hover_color2 : '#444' ?>;     
              --social_icon_color: <?php echo $social_icon_color ? $social_icon_color : '000' ?>;
              --social_icon_hover_color: <?php echo $social_icon_hover_color ? $social_icon_hover_color : '#444' ?>;          
              --copyright_text_color: <?php echo $copyright_text_color ? $copyright_text_color : '#000' ?>;   
              --flowyt_max_width: 1200px;                         
            }            
            #theme-header {
                background-color: <?php echo $header_bg ? $header_bg : DEF_HEADER_BG ?>;
            }
            #theme-footer {
                background-color: <?php echo $footer_bg ? $footer_bg : DEF_FOOTER_BG ?>;
            }
        </style>
        <?php
    }

    public static function register_my_menu() {
      register_nav_menu('header-menu', __('Header Menu'));
      register_nav_menu('footer-menu-1', __('Footer Menu 1'));
      register_nav_menu('footer-menu-2', __('Footer Menu 2'));
    }
 
	public static function enqueue_parent_styles() {
	   $folder = Flowyth_Main::__getPluginURL();
       
       wp_enqueue_style('flowy-fontawesome', $folder . '/styles/fontawesome/css/all.css', null, time());
       wp_enqueue_style('flowy-reset', $folder . '/styles/reset.css', null, time());
       wp_enqueue_style('flowy-layout', $folder . '/styles/layout.css', null, time());
       wp_enqueue_style('flowy-design', $folder . '/styles/design.css', null, time());

       wp_enqueue_script('flowy-scripts', $folder . '/scripts/wp-scripts.js', null, time());

       $google_fonts = array('Poppins', 'Raleway', 'Montserrat', 'Roboto');

       self::__includeGoogleFontsForCustomizer($google_fonts);
	}

	public static function __pluginsLoaded() {

	}

	public static function __init() {

	} //func:__init

    public static function __includeGoogleFontsForCustomizer($include_fonts = false) {
        $google_fonts = array('Roboto' => 'https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap',
                              'Roboto Mono' => 'https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap',
                              'Roboto Condensed' => 'https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap',
                              'Roboto Flex' => 'https://fonts.googleapis.com/css2?family=Roboto+Flex:opsz,wght,XOPQ,XTRA,YOPQ,YTDE,YTFI,YTLC,YTUC@8..144,100..1000,96,468,79,-203,738,514,712&display=swap',
                              'Open Sans' => 'https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap',
                              'Montserrat' => 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap',
                              'Poppins' => 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap',
                              'Lato' => 'https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap',
                              'Rubik' =>  'https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=Roboto:ital,wght@0,100..900;1,100..900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap',
                             'Oswald' => 'https://fonts.googleapis.com/css2?family=Bitcount+Grid+Double+Ink:wght@100..900&family=Oswald:wght@200..700&family=Roboto+Flex:opsz,wght,XOPQ,XTRA,YOPQ,YTDE,YTFI,YTLC,YTUC@8..144,100..1000,96,468,79,-203,738,514,712&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap',
                              'Raleway' => 'https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap');


        if ($include_fonts && is_array($include_fonts)) {
            foreach($include_fonts as $name) {
                if (isset($google_fonts[$name])) {
                    wp_enqueue_style('gf-' . strtolower(str_replace(' ', '-', $name)), $google_fonts[$name], array(), null );           
                }
            }
        }
        else {
            foreach($google_fonts as $g => $url) {
                wp_enqueue_style('gf-' . strtolower(str_replace(' ', '-', $g)), $url, array(), null );      
            }
        }
    }    
} //class