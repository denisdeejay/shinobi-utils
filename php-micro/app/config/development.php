<?php

class config_development extends config_global {

	private $config = array();

	public function config_development(){
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
	}
}