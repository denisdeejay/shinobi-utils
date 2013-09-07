<?php
class application {

	private static $instance;
	private $config;
	private $dispatch;
	private $language;
	private $router;

	protected function __construct(){}
    protected function __clone(){}

    public static function get_instance()
    {
        if (!isset(static::$instance)) {
            static::$instance = new static;
        }
        return static::$instance;
    }

	public function init(){
		
		// Autoload
		function __autoload($class) {
			$class = str_replace("_", "/", $class);
			require_once("$class.php");
		}

		// Auto config
		$config = 'config_'.ENVIRONMENT;
		$this->config = new $config();
		unset($config);

		// Routes
		$this->router = new router();
		$controller = 'controllers_'.$this->router->get_controller();
		$method = $this->router->get_method();

		// Language
		$language = 'language_'.$this->config->get_language();
		$this->language = new $language($this->config->get_language());
		unset($language);

		// Dispatch
		$this->dispatch = new $controller();
		$this->dispatch->$method();

		unset($controller, $method);

		exit;
	}	

	public function get_config() {
		return $this->config;
	}

	public function get_language() {
		return $this->language;
	}

	public function get_param($index) {
		return $this->router->get_param($index);
	}
	
	public function get_params() {
		return $this->router->get_params();
	}

	public function get_router() {
		return $this->router;
	}

	public function render_view($view, $data) {

		$config = $this->config;
		$lang = $this->language;
		$router = $this->router;
		$params = $this->router->get_params();
		
		$view = PATH_APP . '/views/' . $view . '.phtml';

		ob_start();
		require($view);
		unset($config, $data, $lang, $router, $view);

		return ob_get_clean();
	}
}