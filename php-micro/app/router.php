<?php
class router {

	private $controller;
	private $method;
	private $query_string;
	private $root_path;
	private $route;

	public function router() {
		$config = application::get_instance()->get_config();
		$this->root_path = dirname($_SERVER['SCRIPT_NAME']);
		$_SERVER['QUERY_STRING'] === '' ? $this->query_string = '/' : $this->query_string = $_SERVER['QUERY_STRING'];

		// Strip language code prefix from route (/en)
		if($this->query_string !== '/') {

			// Trim trailing slash and redirect
			if(substr($this->query_string, strlen($this->query_string)-1) === '/') {
				header("HTTP/1.1 301 Moved Permanently");
				header('Location: ' . $this->root_path . substr($this->query_string, 0, strlen($this->query_string)-1));
				exit;
			}

			// Check that the language is enabled in config
			$url = explode('/', ltrim($this->query_string, '/'));

			if(array_key_exists($url[0], $config->get_languages())) {
				
				$config->set_language($url[0]);

				if(count($url) <= 1) {
					
					// Language only URL (/en, /de etc)
					$this->query_string = '/';
				} else {

					// Trim the language prefix from the URL for the router
					if(substr($this->query_string, 0, 4) == '/'.$url[0].'/') {
						$this->query_string = substr($this->query_string, 3, strlen($this->query_string)-3);
					}
				}
			} else {
				// Check if we should redirect to a url with the language prefix.
				if($config->get_language_enforce() === true) {
					
					// Redirect to default language url...
					header("HTTP/1.1 301 Moved Permanently");
					header('Location: ' . $this->root_path . '/' . $config->get_language_default() . $this->query_string);
					exit;
				}
			}
		}
		
		// Check route exists
		$routes = $config->get_routes();
		if(!array_key_exists($this->query_string, $routes)) Throw new Exception();

		// Set route
		$this->route = explode('@', $routes[$this->query_string]);
		unset($config, $routes);
	}

	public function get_controller() {
		return $this->route[0];
	}

	public function get_method() {
		return $this->route[1];
	}
}