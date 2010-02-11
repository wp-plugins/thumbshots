<?php

class ThumbshotsPlugin {

	var $plugin_name;
	var $plugin_base;
	var $url;
	var $pre = 'thumbs_';
	var $debugging = false;

	function register_plugin($name, $base) {
		$this -> plugin_name = $name;
		$this -> plugin_base = rtrim(dirname($base), DS);
		
		return;
	}
	
	function initialize_options() {
		$this -> add_option('linkthumbs', "Y");
		$this -> add_option('autobacklink', "Y");
		
		return;
	}
	
	function add_action($action, $function = null, $priority = 10, $params = 1) {
		if (add_action($action, array($this, ((empty($function)) ? $action : $function)), $priority, $params)) {
			return true;
		}
		
		return false;
	}
	
	function debug($var = array()) {
		if ($this -> debugging == true) {
			echo '<pre>' . print_r($var, true) . '</pre>';
			flush();
		}
		
		return true;
	}
	
	function add_option($name = '', $value = '') {
		if (add_option($this -> pre . $name, $value)) {
			return true;
		}
		
		return false;
	}
	
	function update_option($name = '', $value = '') {
		if (update_option($this -> pre . $name, $value)) {
			return true;
		}
		
		return false;
	}
	
	function get_option($name = '', $stripslashes = true) {
		if ($option = get_option($this -> pre . $name)) {
			if (@unserialize($option) !== false) {
				return unserialize($option);
			}
			
			if ($stripslashes == true) {
				$option = stripslashes_deep($option);
			}
			
			return $option;
		}
		
		return false;
	}
	
	function delete_option($name = '') {
		if (!empty($name)) {
			if (delete_option($this -> pre . $name)) {
				return true;
			}
		}
		
		return false;
	}
	
	function render_error($message) {
		$this -> render('error', array('message' => $message), true, 'admin');
		flush();
	}
	
	function render_message($message) {
		$this -> render('message', array('message' => $message), true, 'admin');
		flush();
	}
	
	function render($file = '', $params = array(), $output = true, $folder = 'default') {
		if (empty($this -> plugin_base)) {
			$this -> plugin_base = rtrim(dirname(__FILE__), DS);
		}
	
		if (!empty($file)) {
			$filename = $file . '.php';
			$filepath = $this -> plugin_base . DS . 'views' . DS . $folder . DS;
			$filefull = $filepath . $filename;
			
			if (!empty($params)) {
				foreach ($params as $key => $val) {
					${$key} = $val;
				}
			}
			
			if (file_exists($filefull)) {
				if ($output == false) {
					ob_start();
				}
			
				include($filefull);
				
				if ($output == false) {
					$data = ob_get_clean();
					return $data;
				} else {
					flush();
					return true;
				}
			}
		}
	}
}

?>