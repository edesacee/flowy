<?php
namespace flowyth;

if(!class_exists('flowyth\Main')) {

	class Main {
		protected $_plugin_url; 
		protected $_plugin_folder; 
		protected $_script_version;
		protected $_style_version;

		static protected $__plugin_path;
		static protected $__plugin_url;
		static protected $__plugin_file;


		public function __construct($file, $options = array()) {
			$class_name = get_class();

			if (!$file) {
				throw new Error('Missing 1 argument'); 
			}

			$this->_plugin_url		= get_stylesheet_directory_uri();
			$this->_plugin_folder	= basename(dirname($file));

			if (isset($options ['script_version'])) {
				$this->_script_version	= $options ['script_version'];	
			}

			if (isset($options ['style_version'])) {
				$this->_style_version	= $options ['style_version'];	

			}

			self::$__plugin_url			= get_stylesheet_directory_uri();
			self::$__plugin_path		= plugin_dir_path($file);
			self::$__plugin_file		= $file;

			add_action('admin_enqueue_scripts', array($this, 'addAdminScripts'));
			add_action('wp_enqueue_scripts', array($class_name, '__insertJquery'), 1);
			add_action('wp_footer', array($this, 'addWebsiteScripts'));
		}

		public static function __insertJquery(){
			wp_enqueue_script('jquery', false, array(), false, false);
		} //function

		public function getPluginUrl() {
			return $this->_plugin_url;
		}

		public static function __log($msg, $filename = 'log.txt') {
			@mkdir(self::__getPluginPath() . 'logs');

			$fp = fopen(self::__getPluginPath() . 'logs/' . $filename, 'a');
			fwrite($fp, "\n" . current_time('m d y h:i:s A') . ' => '. $msg);
			fclose($fp);
		}

		public static function __logSms($to,  $message, $sms_sent, $loc_guid, $campaign_guid, $status) {
			$fp = fopen(self::__getPluginPath() . 'sms-log.csv', 'a');
			fputcsv($fp, array($to, $sms_sent, $loc_guid, $campaign_guid, $status, $message));
			fclose($fp);
		}

		/**
		* adds scripts and css to website pages
		* @action wp_footer
		*/
		public function addWebsiteScripts() {
			wp_enqueue_media();
			wp_enqueue_script('jquery');

			//should make sure these files exists

			$wp_scripts	= $this->_plugin_url . '/scripts/wp-scripts.js';
			$wp_styles	= $this->_plugin_url . '/styles/wp-styles.css';

			if (file_exists(self::$__plugin_path . '/scripts/wp-scripts.js')) {
				wp_enqueue_script($this->_plugin_folder . '-wp-scripts', $wp_scripts, array(), $this->_script_version ? $this->_script_version : 100);
			}

			if (file_exists(self::$__plugin_path . 'styles/wp-styles.css')) {
				wp_enqueue_style($this->_plugin_folder . '-wp-styles', $wp_styles, array(), $this->_style_version ? $this->_style_version : 100);
			}
		}


		/**
		* adds scripts and css to admin pages
		* @action admin_enqueue_scripts
		*/
		public function addAdminScripts() {
			wp_enqueue_media();
			wp_enqueue_script('jquery');

			$admin_scripts = $this->_plugin_url . 'scripts/admin-scripts.js';
			$admin_styles  = $this->_plugin_url . 'styles/admin-styles.css';

			if (file_exists(self::$__plugin_path . 'scripts/admin-scripts.js')) {
				wp_enqueue_script($this->_plugin_folder . '-admin-scripts', $admin_scripts, array(), $this->_script_version ? $this->_script_version : false);
			}

			if (file_exists(self::$__plugin_path . 'styles/admin-styles.css')) {
				wp_enqueue_style($this->_plugin_folder . '-admin-styles', $admin_styles, array(), $this->_style_version ? $this->_style_version : false);
			}
		}

		public static function __getPluginPath() {
			return self::$__plugin_path;
		}

		public static function __getPluginURL() {
			return self::$__plugin_url;
		}

		public static function __getPluginVersion() {
			$headers = array('plugin_name' => 'Plugin Name',
		 					 'description' => 'Description',
		 					 'author' => 'Author',
		 					 'version' => 'Version');

			$pluginfo = get_file_data(self::$__plugin_file, $headers);
			return $pluginfo['version'];
		}

	} // end of class

} //if