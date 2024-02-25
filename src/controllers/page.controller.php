<?php
/**
 * The Page Controller, extends the abstract controller, which only has the render method, since all controllers 
 * render a view.  The main job here, is to call the PageService to get the correct data, and then send that data
 * to the proper view.  Currently there are only two methods, index and get_page_by_slug().  the index just shows
 * the home page, while get page by slug attempts to find the needed page in the database before passing it to the 
 * view.  We could add as many different methods here as we want.  maybe we add a get_pages() method that will get
 * all of the pages we have and then pass that to a list view.  Or maybe we have a speficic type of view we need 
 * for one single page.  We would set that up here as well.
 */
require(ABS_PATH . '/' . 'src/controllers/abstract.controller.php');
require(ABS_PATH . '/' . 'src/services/page.service.php');

class PageController extends AbstractController{
	private $_pageService;

	function __construct(DatabaseInterface $database){
		$this->_pageService = PageService::get_instance($database);
	}


	public function index():void{
		include_once(ABS_PATH . '/' . 'src/views/home.view.php');
	}

	public function get_page(array $data):void{
		//display the correct page, or 404 if not found.
		$page = $this->_pageService->get_page_by_slug($data[0]);

		($page != null) ? 
			include_once(ABS_PATH . '/' . 'src/views/page.view.php') :
			include_once(ABS_PATH . '/' . 'src/views/404.php');
	}
}