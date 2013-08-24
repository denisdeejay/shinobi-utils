<?php

class config_production extends config_global {

	private $config = array();

	public function config_production(){
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
	}
}