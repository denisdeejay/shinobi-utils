<?php

class router {

	private $controller;
	private $method;
	private $query_string;
	private $route;

	public function router() {
		$languages = application::get_instance()->get_config()->get_languages();
		$routes = application::get_instance()->get_config()->get_routes();

		$_SERVER['QUERY_STRING'] == '' ? $this->query_string = '/' : $this->query_string = $_SERVER['QUERY_STRING'];

		// Strip language code prefix (/en)
		if($this->query_string !== '/') {
			$url = explode('/', $this->query_string);
			if(array_key_exists($url[1], $languages)) {
				$this->query_string = ltrim($this->query_string, '/'.$url[1].'/');
				application::get_instance()->get_config()->set_language($url[1]);
			}
		}

		// Check route
		if(!array_key_exists($this->query_string, $routes)) Throw new Exception();

		// Set route
		$this->route = explode('@', $routes[$this->query_string]);
	}

	public function get_controller() {
		return $this->route[0];
	}

	public function get_method() {
		return $this->route[1];
	}
}