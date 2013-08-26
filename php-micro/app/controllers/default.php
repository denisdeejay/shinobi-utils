<?php

class controllers_default {

	private $data = array('hi'=>'2u');

	public function controllers_default() {
	}

	public function index() {
		echo application::get_instance()->render_view('default', $this->data);
	}

	public function demo() {
		echo application::get_instance()->render_view('demo', $this->data);
	}
}