
<?php

class Flowyth_Customizer extends flowyth\Main {
	public function __construct() {
		$class_name = get_class();
		add_action('customize_register', array($class_name, 'customizeTheme'));
	}

	public static function socialMedia($wp_customize) {
        $wp_customize->add_setting('instagram', array('default' => ''));
        $wp_customize->add_setting('facebook', array('default' => ''));
        $wp_customize->add_setting('youtube', array('default' => ''));
        $wp_customize->add_setting('pinterest', array('default' => ''));
        $wp_customize->add_setting('twitter', array('default' => ''));
        $wp_customize->add_setting('tiktok', array('default' => ''));

        //Section
        $wp_customize->add_section(
            'social-media',
            array(
                'title' => __( 'Social Media', '_s' ),
                'priority' => 100,
                'description' => __( 'Enter the URL to your accounts for each social media for the icon to appear in the header.', '_s' )
        ));

        //Control
        //Instragram
        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize, 'instagram',
                array(
                    'label' => __( 'Instagram', '_s' ),
                    'section' => 'social-media',
                    'settings' => 'instagram'
        )));

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize, 'facebook',
                array(
                    'label' => __( 'Facebook', '_s' ),
                    'section' => 'social-media',
                    'settings' => 'facebook'
        )));

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize, 'youtube',
                array(
                    'label' => __( 'Youtube', '_s' ),
                    'section' => 'social-media',
                    'settings' => 'youtube'
        )));

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize, 'pinterest',
                array(
                    'label' => __( 'Pinterest', '_s' ),
                    'section' => 'social-media',
                    'settings' => 'pinterest'
        )));

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize, 'twitter',
                array(
                    'label' => __( 'Twitter', '_s' ),
                    'section' => 'social-media',
                    'settings' => 'twitter'
        )));        

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize, 'tiktok',
                array(
                    'label' => __( 'Tiktok', '_s' ),
                    'section' => 'social-media',
                    'settings' => 'tiktok'
        )));        
	}

	public static function footerSettings($wp_customize) {
        $wp_customize->add_setting('enable_instagram', array('default' => false));
        $wp_customize->add_setting('enable_facebook', array('default' => false));
        $wp_customize->add_setting('enable_youtube', array('default' => false));
        $wp_customize->add_setting('enable_pinterest', array('default' => false));
        $wp_customize->add_setting('enable_twitter', array('default' => false));
        $wp_customize->add_setting('enable_tiktok', array('default' => false));
        $wp_customize->add_setting('copyright_text', array('default' => 'Copyright 2025 © EC Theme'));

        $wp_customize->add_setting('flowy_footer_company_name', array('default' => 'Company Name'));
        $wp_customize->add_setting('flowy_footer_company_description', array('default' => '{enter address or company details}'));

        //Section
        $wp_customize->add_section(
            'ect-footer',
            array(
                'title' => __( 'Footer Settings', '_s' ),
                'priority' => 139,
                // 'description' => __( 'Enter the URL to your accounts for each social media for the icon to appear in the header.', '_s' )
        ));  

        //Control
        //Instragram
        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize, 'enable_instagram',
                array(
                    'label' => __( 'Instagram', '_s' ),
                    'type' => 'checkbox',
                    'section' => 'ect-footer',
                    'settings' => 'enable_instagram'
                )));   

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize, 'enable_facebook',
                array(
                    'label' => __( 'Facebook', '_s' ),
                    'type' => 'checkbox',
                    'section' => 'ect-footer',
                    'settings' => 'enable_facebook'
        )));

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize, 'enable_youtube',
                array(
                    'label' => __( 'Enable Youtube', '_s' ),
                    'type' => 'checkbox',
                    'section' => 'ect-footer',
                    'settings' => 'enable_youtube'
        )));    

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize, 'enable_pinterest',
                array(
                    'label' => __( 'Enable Pinterest', '_s' ),
                    'type' => 'checkbox',
                    'section' => 'ect-footer',
                    'settings' => 'enable_pinterest'
        ))); 

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize, 'enable_twitter',
                array(
                    'label' => __( 'Enable Twitter', '_s' ),
                    'type' => 'checkbox',
                    'section' => 'ect-footer',
                    'settings' => 'enable_twitter'
        )));                      

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize, 'enable_tiktok',
                array(
                    'label' => __( 'Enable Tiktok', '_s' ),
                    'type' => 'checkbox',
                    'section' => 'ect-footer',
                    'settings' => 'enable_tiktok'
        )));

        $wp_customize->add_control('flowy_footer_company_name', array(
            'label'    => __( 'Company Name', 'flowy' ),
            'section'  => 'ect-footer', // Or your custom section
            'settings' => 'flowy_footer_company_name',
            'type'     => 'text', // Defines it as a textarea
        ));

        $wp_customize->add_control('flowy_footer_company_description', array(
            'label'    => __( 'Company Details', 'flowy' ),
            'section'  => 'ect-footer', // Or your custom section
            'settings' => 'flowy_footer_company_description',
            'type'     => 'textarea', // Defines it as a textarea
        ));        

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize, 'copyright_text',
                array(
                    'label'      => __( 'Copyright Text', 'textdomain' ),
                    // 'description' => __( '....', 'textdomain' ),
                    'settings'   => 'copyright_text',
                    'priority'   => 10,
                    'section'    => 'ect-footer',
                    'type'       => 'text',
        )));                       
	}

	public static function generalSettings($wp_customize) {
        $wp_customize->add_setting('content_width', array('default' => '1100'));
        $wp_customize->add_setting('font_family', array('default' => ''));

        // Section
        $wp_customize->add_section(
            'ect-general',
            array(
                'title' => __('Layout & Colors', '_s'),
                'priority' => 140,
                // 'description' => __('', '_s' )
        )); 

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize, 'content_width',
                array(
                    'label' => __( 'Content Width (in pixels)', '_s' ),
                    'type' => 'text',
                    'section' => 'ect-general',
                    'settings' => 'content_width',
                    // 'description' => 'Content width in pixel',
        )));

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize, 'font_family',
                array(
                    'label' => __( 'Font Family', '_s' ),
                    'section' => 'ect-general',
                    'settings' => 'font_family'
        )));
	}

	public static function themeOptions($wp_customize) {
        $wp_customize->add_setting(
            'custom_logo',
            array(
                'default' => '230',
                'type' => 'theme_mod', // you can also use 'theme_mod'
                'capability' => 'edit_theme_options'
        ));

        $wp_customize->add_control(
            new WP_Customize_Media_Control(
                $wp_customize, 'custom_logo', 
                array(
                    'label' => __('Site Logo', 'theme_textdomain'),
                    'section' => 'title_tagline',
                    'mime_type' => 'image',
        )));		
	}

    public static function homepageContent($wp_customize) {
        $theme_slug = get_stylesheet();

        $wp_customize->add_setting('flowy_enable_introduction', array('default' => true));
        $wp_customize->add_setting('flowy_intro_title', array('default' => FLOWY_DEFAULT_TITLE));
        $wp_customize->add_setting('flowy_intro_subtitle', array('default' => FLOWY_DEFAULT_SUBTITLE));
        $wp_customize->add_setting('flowy_intro_paragraph', array(
            'default'           => FLOWY_DEFAULT_PARAGRAPH,
            'sanitize_callback' => 'wp_filter_post_kses', // Sanitize HTML
        ));

        if (function_exists('wc_get_page_permalink')) {
            $shop_url = wc_get_page_permalink( 'shop' );    
        }
        else {
            $shop_url = '';
        }

        $read_more_url = get_bloginfo('wpurl');

        $wp_customize->add_setting('flowy_intro_read_more_url', array('default' => $read_more_url));
        $wp_customize->add_setting('flowy_intro_shop_url', array('default' => $shop_url));

        $wp_customize->add_setting(
            'flowy_intro_image',
            array(
                'default' => '',
                // 'type' => 'theme_mod', // you can also use 'theme_mod'
                // 'capability' => 'edit_theme_options'
        ));

        $wp_customize->add_setting('flowy_intro_image_alt', array('default' => FLOWY_DEFAULT_TITLE));
                   
        // Section
        $wp_customize->add_section(
            'ect-homepage-content',
            array(
                'title' => __('Homepage Content', '_s'),
                'priority' => 138,
                // 'description' => __('', '_s' )
        ));

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize, 'flowy_enable_introduction',
                array(
                    'label' => __( 'Enable Introduction', '_s' ),
                    'type' => 'checkbox',
                    'section' => 'ect-homepage-content',
                    'settings' => 'flowy_enable_introduction'
                )));   

        $wp_customize->add_control('flowy_intro_title', array(
            'label'    => __( 'Title', 'flowy' ),
            'section'  => 'ect-homepage-content', // Or your custom section
            'settings' => 'flowy_intro_title',
            'type'     => 'text', // Defines it as a textarea
        ));

        $wp_customize->add_control('flowy_intro_subtitle', array(
            'label'    => __( 'Subtitle', 'flowy' ),
            'section'  => 'ect-homepage-content', // Or your custom section
            'settings' => 'flowy_intro_subtitle',
            'type'     => 'text', // Defines it as a textarea
        ));        
        $wp_customize->add_control('flowy_intro_paragraph', array(
            'label'    => __( 'Content', 'flowy' ),
            'section'  => 'ect-homepage-content', // Or your custom section
            'settings' => 'flowy_intro_paragraph',
            'type'     => 'textarea', // Defines it as a textarea
        ));

        $wp_customize->add_control('flowy_intro_shop_url', array(
            'label'    => __( 'Shop URL', 'flowy' ),
            'section'  => 'ect-homepage-content', // Or your custom section
            'settings' => 'flowy_intro_shop_url',
            'type'     => 'text', // Defines it as a textarea
        ));

        $wp_customize->add_control('flowy_intro_read_more_url', array(
            'label'    => __( 'Read More URL', 'flowy' ),
            'section'  => 'ect-homepage-content', // Or your custom section
            'settings' => 'flowy_intro_read_more_url',
            'type'     => 'text', // Defines it as a textarea
        ));    

        $wp_customize->add_control(
            new WP_Customize_Media_Control(
                $wp_customize, 'flowy_intro_image', 
                array(
                    'label' => __('Featured Image', 'theme_textdomain'),
                    'section'  => 'ect-homepage-content', // Or your custom section
                    'settings' => 'flowy_intro_image',
                    'mime_type' => 'image',
        )));    

        $wp_customize->add_control('flowy_intro_image_alt', array(
            'label'    => __( 'Image Alt Text', 'flowy' ),
            'section'  => 'ect-homepage-content', // Or your custom section
            'settings' => 'flowy_intro_image_alt',
            'type'     => 'text', // Defines it as a textarea
        ));   
                   

        self::__counterFields($wp_customize);    

        if (class_exists( 'WooCommerce')) {
            self::__featuredProductsFields($wp_customize);      
        }        

        self::__specialOfferFields($wp_customize);
        self::__contactFields($wp_customize);
        
    }

    public static function __contactFields($wp_customize) {
        $theme_slug = get_stylesheet();

        $wp_customize->add_setting('flowy_enable_contact_section', array('default' => true));
        $wp_customize->add_setting('flowy_contact_title', array('default' => FLOWY_DEFAULT_TITLE));
        $wp_customize->add_setting('flowy_contact_content', array('default' => 'Enter Contact Form 7 Shortcode'));
        $wp_customize->add_setting('flowy_contact_subtitle', array('default' => FLOWY_DEFAULT_SUBTITLE));

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize, 'flowy_enable_contact_section',
                array(
                    'label' => __( 'Enable Contact Section', '_s' ),
                    'type' => 'checkbox',
                    'section' => 'ect-homepage-content',
                    'settings' => 'flowy_enable_contact_section'
                )));   

        $wp_customize->add_control('flowy_contact_title', array(
            'label'    => __( 'Title', 'flowy' ),
            'section'  => 'ect-homepage-content', // Or your custom section
            'settings' => 'flowy_contact_title',
            'type'     => 'text', // Defines it as a textarea
        ));

        $wp_customize->add_control('flowy_contact_content', array(
            'label'    => __( 'Contact Form 7', 'flowy' ),
            'section'  => 'ect-homepage-content', // Or your custom section
            'settings' => 'flowy_contact_content',
            'type'     => 'text', // Defines it as a textarea
            'description' => __('Accepts Contat Form7 Shortcode Only', 'flowy'),
        ));        

        $wp_customize->add_control('flowy_contact_subtitle', array(
            'label'    => __( 'Subtitle', 'flowy' ),
            'section'  => 'ect-homepage-content', // Or your custom section
            'settings' => 'flowy_contact_subtitle',
            'type'     => 'text', // Defines it as a textarea
        ));
    }

    public static function __specialOfferFields($wp_customize) {
        $theme_slug = get_stylesheet();

        $wp_customize->add_setting('flowy_enable_special_offer', array('default' => true));
        $wp_customize->add_setting('flowy_special_offer_title', array('default' => 'Special Offer'));
        $wp_customize->add_setting('flowy_special_offer_content', array('default' => '20%'));
        $wp_customize->add_setting('flowy_special_offer_subtitle', array('default' => 'For the first 20 customers.'));

        $wp_customize->add_setting(
            'flowy_special_offer_image',
            array(
                'default' => '',
        ));

        $wp_customize->add_setting('flowy_special_offer_image_alt', array('default' => 'Special Offer'));

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize, 'flowy_enable_special_offer',
                array(
                    'label' => __( 'Enable Special Offer', '_s' ),
                    'type' => 'checkbox',
                    'section' => 'ect-homepage-content',
                    'settings' => 'flowy_enable_special_offer'
                )));   

        $wp_customize->add_control('flowy_special_offer_title', array(
            'label'    => __( 'Title', 'flowy' ),
            'section'  => 'ect-homepage-content', // Or your custom section
            'settings' => 'flowy_special_offer_title',
            'type'     => 'text', // Defines it as a textarea
        ));

        $wp_customize->add_control('flowy_special_offer_content', array(
            'label'    => __( 'Offer', 'flowy' ),
            'section'  => 'ect-homepage-content', // Or your custom section
            'settings' => 'flowy_special_offer_content',
            'type'     => 'text', // Defines it as a textarea
        ));        

        $wp_customize->add_control('flowy_special_offer_subtitle', array(
            'label'    => __( 'Subtitle', 'flowy' ),
            'section'  => 'ect-homepage-content', // Or your custom section
            'settings' => 'flowy_special_offer_subtitle',
            'type'     => 'text', // Defines it as a textarea
        ));

        $wp_customize->add_control(
            new WP_Customize_Media_Control(
                $wp_customize, 'flowy_special_offer_image', 
                array(
                    'label' => __('Featured Image', 'theme_textdomain'),
                    'section'  => 'ect-homepage-content', // Or your custom section
                    'settings' => 'flowy_special_offer_image',
                    'mime_type' => 'image',
        )));    

        $wp_customize->add_control('flowy_special_offer_image_alt', array(
            'label'    => __( 'Image Alt Text', 'flowy' ),
            'section'  => 'ect-homepage-content', // Or your custom section
            'settings' => 'flowy_special_offer_image_alt',
            'type'     => 'text', // Defines it as a textarea
        ));   
    }

    public static function __featuredProductsFields($wp_customize) {
        $wp_customize->add_setting('flowy_enable_featproducts', array('default' => true));
        $wp_customize->add_setting('flowy_featproducts_title', array('default' => FLOWY_DEFAULT_TITLE));
        $wp_customize->add_setting('flowy_featproducts_subtitle', array('default' => FLOWY_DEFAULT_SUBTITLE));
        $wp_customize->add_setting('flowy_featproducts_ids', array('default' => ''));

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize, 'flowy_enable_featproducts',
                array(
                    'label' => __( 'Enable Featured Products', '_s' ),
                    'type' => 'checkbox',
                    'section' => 'ect-homepage-content',
                    'settings' => 'flowy_enable_featproducts',
                    // 'description' => __('To feature a product, edit the product. Go to Flowy Theme tab, and check Feature this product.', 'flowy'),
                )));

        $wp_customize->add_control('flowy_featproducts_title', array(
            'label'    => __( 'Title', 'flowy' ),
            'section'  => 'ect-homepage-content', // Or your custom section
            'settings' => 'flowy_featproducts_title',
            'type'     => 'text', // Defines it as a textarea
        ));    

        $wp_customize->add_control('flowy_featproducts_subtitle', array(
            'label'    => __( 'Subtitle', 'flowy' ),
            'section'  => 'ect-homepage-content', // Or your custom section
            'settings' => 'flowy_featproducts_subtitle',
            'type'     => 'text', // Defines it as a textarea
        ));    

        $wp_customize->add_control('flowy_featproducts_ids', array(
            'label'    => __( 'Product IDs', 'flowy' ),
            'section'  => 'ect-homepage-content', // Or your custom section
            'settings' => 'flowy_featproducts_ids',
            'type'     => 'text', // Defines it as a textarea
            'description' => __('separated by comma', 'flowy'),
        ));                                                
    }

    public static function __counterFields($wp_customize) {
        $wp_customize->add_setting('flowy_enable_counters', array('default' => true));

        $wp_customize->add_setting('flowy_counter_label1', array('default' => 'Sold This Month'));
        $wp_customize->add_setting('flowy_counter_value1', array('default' => '3000+'));

        $wp_customize->add_setting('flowy_counter_label2', array('default' => '5 Star Rating'));
        $wp_customize->add_setting('flowy_counter_value2', array('default' => '1000+'));

        $wp_customize->add_setting('flowy_counter_label3', array('default' => 'Repeat Customers'));
        $wp_customize->add_setting('flowy_counter_value3', array('default' => '500+'));

        $wp_customize->add_setting('flowy_counter_label4', array('default' => 'Years of Experience'));
        $wp_customize->add_setting('flowy_counter_value4', array('default' => '7+'));

        $wp_customize->add_setting('flowy_counter_label5', array('default' => ''));
        $wp_customize->add_setting('flowy_counter_value5', array('default' => ''));     

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize, 'flowy_enable_counters',
                array(
                    'label' => __( 'Enable Counters', '_s' ),
                    'type' => 'checkbox',
                    'section' => 'ect-homepage-content',
                    'settings' => 'flowy_enable_counters'
                )));       

        $wp_customize->add_control('flowy_counter_label1', array(
            'label'    => __( 'Label', 'flowy' ),
            'section'  => 'ect-homepage-content', // Or your custom section
            'settings' => 'flowy_counter_label1',
            'type'     => 'text', // Defines it as a textarea
        ));

        $wp_customize->add_control('flowy_counter_value1', array(
            'label'    => __( 'Value', 'flowy' ),
            'section'  => 'ect-homepage-content', // Or your custom section
            'settings' => 'flowy_counter_value1',
            'type'     => 'text', // Defines it as a textarea
        ));                

        $wp_customize->add_control('flowy_counter_label2', array(
            'label'    => __( 'Label', 'flowy' ),
            'section'  => 'ect-homepage-content', // Or your custom section
            'settings' => 'flowy_counter_label2',
            'type'     => 'text', // Defines it as a textarea
        ));

        $wp_customize->add_control('flowy_counter_value2', array(
            'label'    => __( 'Value', 'flowy' ),
            'section'  => 'ect-homepage-content', // Or your custom section
            'settings' => 'flowy_counter_value2',
            'type'     => 'text', // Defines it as a textarea
        ));

        $wp_customize->add_control('flowy_counter_label3', array(
            'label'    => __( 'Label', 'flowy' ),
            'section'  => 'ect-homepage-content', // Or your custom section
            'settings' => 'flowy_counter_label3',
            'type'     => 'text', // Defines it as a textarea
        ));

        $wp_customize->add_control('flowy_counter_value3', array(
            'label'    => __( 'Value', 'flowy' ),
            'section'  => 'ect-homepage-content', // Or your custom section
            'settings' => 'flowy_counter_value3',
            'type'     => 'text', // Defines it as a textarea
        ));

        $wp_customize->add_control('flowy_counter_label4', array(
            'label'    => __( 'Label', 'flowy' ),
            'section'  => 'ect-homepage-content', // Or your custom section
            'settings' => 'flowy_counter_label4',
            'type'     => 'text', // Defines it as a textarea
        ));

        $wp_customize->add_control('flowy_counter_value4', array(
            'label'    => __( 'Value', 'flowy' ),
            'section'  => 'ect-homepage-content', // Or your custom section
            'settings' => 'flowy_counter_value4',
            'type'     => 'text', // Defines it as a textarea
        ));

        $wp_customize->add_control('flowy_counter_label5', array(
            'label'    => __( 'Label', 'flowy' ),
            'section'  => 'ect-homepage-content', // Or your custom section
            'settings' => 'flowy_counter_label5',
            'type'     => 'text', // Defines it as a textarea
        ));

        $wp_customize->add_control('flowy_counter_value5', array(
            'label'    => __( 'Value', 'flowy' ),
            'section'  => 'ect-homepage-content', // Or your custom section
            'settings' => 'flowy_counter_value5',
            'type'     => 'text', // Defines it as a textarea
        ));                                
    }

	public static function customizeTheme($wp_customize) {
		//https://developer.wordpress.org/themes/customize-api/customizer-objects/
		self::socialMedia($wp_customize);
		self::footerSettings($wp_customize);
        self::homepageContent($wp_customize);
		self::themeOptions($wp_customize);
        self::generalSettings($wp_customize);
	}	
}