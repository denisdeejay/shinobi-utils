<?php
class application {

	private static $instance;
	private $config;
	private $dispatch;
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

		// Routes
		$this->router = new router();
		$controller = 'controllers_'.$this->router->get_controller();
		$method = $this->router->get_method();

		// Dispatch
		$this->dispatch = new $controller();
		$this->dispatch->$method();

		exit;
	}	

	public function get_config() {
		return $this->config;
	}

	public function render_view($view, $data) {
		$view = PATH_APP . '/views/' . $view . '.phtml';

		ob_start();
		require($view);
		return ob_get_clean();
	}
}