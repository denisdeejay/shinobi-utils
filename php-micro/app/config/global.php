<?php

class config_global {

	private $config = array(
		'EC'=>'v1.0'
	);

	/*
	 * Set the default country code
	 */
	private $language = 'en';

	/*
	 *  Please use ISO 3166-1 to enable languages
	 */
	private $languages = array('en'=>'english');

	/*
	 * '*url*'=>'*controller*@*index*'
	 */
	private $routes = array(
		'/'=>'default@index',
		'/demo/{1}/{2}'=>'demo@index'
	);

	public function config_global(){
	}

	public function get_language() {
		return $this->language;
	}

	public function set_language($language) {
		if(in_array($language, $this->languages)) $this->language = $language;
		return $this->language;
	}

	public function get_languages() {
		return $this->languages;
	}

	public function get_routes() {
		return $this->routes;
	}

	public function __get($key)
	{
		if(!empty($this->config[$key]))
		{
			return $this->config[$key];	
		}
	}
}