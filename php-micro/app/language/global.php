<?php
class language_global {

	protected $lang = array(
	);

	public function language_global() {
	}

	public function __get($key)
	{
		if(isset($this->lang[$key]))
		{
			return $this->lang[$key];	
		}
	}
}