<?php
class router {

	private $controller;
	private $method;
	private $full_uri;
	private $params;
	private $protocol;
	private $query_string;
	private $route;
	private $root_path;
	private $sub_path;

	public function router() {
		
		// Full URI
		$_SERVER['SERVER_PORT'] === '443' ? $this->protocol = 'https' : $this->protocol = 'http';
		$this->full_uri = $this->protocol . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

		// Config reference
		$config = application::get_instance()->get_config();

		// Params
		$this->params = array();

		// Root path
		$this->root_path = dirname($_SERVER['SCRIPT_NAME']);

		// Sub path
		$this->sub_path = $_SERVER['REQUEST_URI'];
		if($this->root_path !== '/')	$this->sub_path = str_replace($this->root_path, '', $this->sub_path);
		
		$url = explode('?', $this->sub_path);

		switch (count($url)) {
			case 0:
			case 1:
				$this->query_string = '/';
			break;
			
			default:
				$this->sub_path = $url[0];
				$this->query_string = $url[1];
			break;
		}

		// Strip language code prefix from route (/en)
		if($this->sub_path !== '/') {

			// Trim trailing slash and redirect
			if(substr($this->sub_path, strlen($this->sub_path)-1) === '/') {
				header('HTTP/1.1 301 Moved Permanently');
				header('Location: ' . $this->root_path . substr($this->sub_path, 0, strlen($this->sub_path)-1));
				exit;
			}

			// Check that the language is enabled in config
			$url = explode('/', ltrim($this->sub_path, '/'));
			if(array_key_exists($url[0], $config->get_languages())) {

				// Set Language
				$config->set_language($url[0]);

				if(count($url) <= 1) {
					
					// Language only URL (/en, /de etc)
					$this->sub_path = '/';
				} else {

					// Trim the language prefix from the URL for the router
					if(substr($this->sub_path, 0, 4) == '/'.$url[0].'/') {
						$this->sub_path = substr($this->sub_path, 3, strlen($this->sub_path)-3);
						if(empty($this->sub_path)) $this->sub_path = '/';
					}
				}
			} else {

				// Check if we should redirect to a url with the language prefix.
				if($config->get_language_enforce() === true) {
					
					// Redirect to default language url...
					header('HTTP/1.1 301 Moved Permanently');
					header('Location: ' . $this->root_path . '/' . $config->get_language_default() . $this->sub_path);
					exit;
				}
			}
		}
		
		// Check route exists
		$routes = $config->get_routes();

		// Check for route parameters
		$broken = false;

		foreach ($routes as $key=>$value) {
			
			// Reset
			$this->params = array();

			// TODO: Error check, check ':' isn't at start of string.
			if(substr($key, 0, 1) == ':') Throw new Exception();

			// Check if params are present...
			$params = explode(':', $key);
			if(count($params) > 1 && ctype_digit($params[1])) {

				// Get params count
				$sub_path_params = array_pop($params);

				// Remove parameters from sub_path.
				if($sub_path_params > 0) {

					$sub_path = explode('/', $this->sub_path);
					for($i = 0; $i < $sub_path_params; $i++) {
						if(count($sub_path) > 0) {
							array_push($this->params, array_pop($sub_path));
						}
					}

					// Put params into order
					$this->params = array_reverse($this->params);

					// Rebuild path without params
					$sub_path = implode('/', $sub_path) . ':' . $sub_path_params;
				}
			} else {
				// No params
				$sub_path_params = 0;
				$sub_path = $this->sub_path;
			}

			// Check route exists
			if($key == $sub_path) {
				break;
			}
		}
		// Check route exists
		if(!array_key_exists($sub_path, $routes)) Throw new Exception();

		// Set route
		$this->route = explode('@', $routes[$sub_path]);
		unset($config, $routes);
	}

	public function get_controller() {
		return $this->route[0];
	}

	public function get_method() {
		return $this->route[1];
	}

	public function get_full_uri() {
		return $this->full_uri;
	}

	public function get_param($index) {
		return $this->params[$index];
	}

	public function get_params() {
		return $this->params;
	}
	
	public function get_root_path() {
		return $this->root_path;
	}

	public function get_sub_path() {
		return $this->sub_path;
	}

	public function get_link_with_root($link) {
		return str_replace('//', '/', $this->root_path . $link);
	}

	public function get_link_with_static($link) {
		$static_path = application::get_instance()->get_config()->get_static_path();

		if(!isset($static_path)) {
			$static_path = $this->root_path . $link;

		} else {
			$static_path = $static_path . $link;
		}

		$static_path = str_replace('//', '/', $static_path);
		$static_path = str_replace('http:/', 'http://', $static_path);
		$static_path = str_replace('https:/', 'https://', $static_path);

		return $static_path;
	}
}