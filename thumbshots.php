<?php

/*
Plugin Name: Thumbshots
Plugin URI: http://tribulant.com
Author: Antonie Potgieter
Author URI: http://tribulant.com
Description: Display website thumbnail previews on your WordPress website using Thumbshots.org. Put <code>[thumbshot url=http://domain.com]</code> into any WordPress post/page and specify any website address for the <code>url</code> parameter.
Version: 1.0.2
*/

if (!defined('DS')) { define('DS', DIRECTORY_SEPARATOR); }

//include the ThumbshotsPlugin class file
require_once(dirname(__FILE__) . DS . 'thumbshots-plugin.php');

//constants
define('DS', DIRECTORY_SEPARATOR);

class Thumbshots extends ThumbshotsPlugin {

	var $name = 'thumbshots';

	function Thumbshots() {	
		$url = explode("&", $_SERVER['REQUEST_URI']);
		$this -> url = $url[0];
		
		//register the plugin name and base
		$this -> register_plugin($this -> name, __FILE__);
		$this -> initialize_options();
		
		//action hooks
		$this -> add_action('admin_menu');
		$this -> add_action('wp_footer');
		
		//shortcodes
		add_shortcode('thumbshot', array($this, 'thumbshot'));
		
		return;
	}
	
	function admin_menu() {
		add_options_page(__('Thumbshots', $this -> plugin_name), __('Thumbshots', $this -> plugin_name), 10, $this -> pre . 'settings', array($this, 'admin_settings'));
		
		return;
	}
	
	function wp_footer() {
		if ($this -> get_option('autobacklink') == "Y") {
			?><a class="thumbshot-backlink" title="Thumbnails Previews by Thumbshots" target="_blank" href="http://www.thumbshots.com">Thumbnails powered by Thumbshots</a><?php
		}
	}
	
	function thumbshot($atts = array(), $content = null, $code = "") {
		$defaults = array('url' => null);
		extract(shortcode_atts($defaults, $atts));
		
		if (!empty($url)) {
			$content = "";
			ob_start();
			
			?><span class="thumbshot"><?php
			
			if ($this -> get_option('linkthumbs') == "Y") {
				?><a class="thubmshot-link" href="<?= $url; ?>"><?php
			}
			
			?><img class="thumbshot-img" src="http://open.thumbshots.org/image.aspx?url=<?= $url; ?>" border="0" /><?php
			
			if ($this -> get_option('linkthumbs') == "Y") {
				?></a><?php
			}
			
			?></span><?php
			
			$content = ob_get_clean();
		}
		
		return $content;
	}
	
	function admin_settings() {
		switch ($_GET['method']) {
			default					:
				if (!empty($_POST)) {
					unset($_POST['submit']);
					
					foreach ($_POST as $pkey => $pval) {
						$this -> update_option($pkey, $pval);
					}
					
					$this -> render_message(__('Configuration settings have been saved', $this -> plugin_name));
				}
			
				$this -> render('settings', false, true, 'admin');
				break;
		}
	}
}

$Thumbshots = new Thumbshots();

?>