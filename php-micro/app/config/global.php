<?php

class config_global {

	protected $config = array(
		'EC'=>'v1.0',
	);

	/*
	 *	The current language
	 */
	protected $language;

	/*
	 * Set the default country code/language
	 */
	protected $language_default = 'en';

	/*
	 * Force redirect to of non language prefixed urls (/ -> /en)
	 */
	protected $language_enforce = true;

	/*
	 *  Please use ISO 3166-1 to enable languages
	 */
	protected $languages = array(
		'en'=>'english',
		'de'=>'german'
	);

	/*
	 * '*url*'=>'*controller*@*index*'
	 */
	protected $routes = array(
		'/'=>'default@index',
		'/demo'=>'default@demo'
	);

	public function config_global(){
	}

	public function get_language() {
		if(!isset($this->language)) $this->language = $this->language_default;
		return $this->language;
	}

	public function set_language($language) {
		if(array_key_exists($language, $this->languages)) $this->language = $language;
		return $this->language;
	}

	public function get_language_default() {
		return $this->language_default;
	}

	public function get_language_enforce() {
		return $this->language_enforce;
	}

	public function get_languages() {
		return $this->languages;
	}

	public function get_routes() {
		return $this->routes;
	}

	public function __get($key)
	{
		if(isset($this->config[$key]))
		{
			return $this->config[$key];	
		}
	}
}