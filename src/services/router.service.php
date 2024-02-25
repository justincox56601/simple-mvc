<?php
/**
 * The router service is the main entry point for this website.  all traffic is redirected to the main index.php page via the 
 * .htaccess file where the request is then passed here to the router.  The router will determine which controller is needed
 * (currently there is only  the PageController) and then passes the slug to that controller.
 */

class RouterService{
	private static $_singleton;
	private $_db;
	private $_routes = [];

	private function __construct(DatabaseInterface $database){
		$this->_db = $database;
		$this->_init();
	}

	public static function get_instance(DatabaseInterface $database):RouterService{
		if(self::$_singleton == null){
			self::$_singleton = new RouterService($database);
		}

		return self::$_singleton;
	}

	private function _init(){
		//call database and get pre defined routes
		$routes = $this->_db->get('routes'); //not a real query, just using it for demo purposes
		foreach($routes as $route){
			$this->add_route($route['route'], $route['controller'], $route['action']);
		}
	}

	public function add_route(string $route, string $controller, string $action){
		$this->_routes[$route] = [
			'controller' => $controller,
			'action' => $action,
		];
	}

	public function dispatch(string $route):void{
		$route = parse_url($route)['path'];

		if(array_key_exists($route, $this->_routes)){
			//checking if the $route is one of our predefined routes.
			//if it is, we instantiate the controller and call the appropiate action
			$controller = $this->_routes[$route]['controller'];
			$action = $this->_routes[$route]['action'];

			require_once(ABS_PATH . '/' . 'src/controllers/' . strtolower($controller) . '.controller.php');
			$controller = ucfirst($controller) . 'Controller';
			$controller = new $controller($this->_db);
			$controller->$action();
		}else if($route != null){
			//here the $route is not one or our predefined routes, so we assume we need the page
			//controller, and try to create the requested page.
			$route = explode('/', $route);
			require_once(ABS_PATH . '/' . 'src/controllers/page.controller.php');

			$controller = new PageController($this->_db);
			$controller->get_page(array_slice($route, 1));
		}else{
			//if something gets this far, we have no way to show the page
			//this will result in a 404 error, and we can show our custome 404 page.
			include_once(ABS_PATH . '/' . 'src/views/404.php');
		}
	}
}