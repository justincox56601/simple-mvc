<?php
/**
 * The page service is responsible for dealing with raw data, and converting it to PageModel objects.
 * Any funcitonality we would need that revolves around pages goes here.
 */

class PageService{
	private static $_singleton;
	private $_db;

	private function __construct(DatabaseInterface $database){
		$this->_db = $database;
	}

	public static function get_instance(DatabaseInterface $database):PageService{
		if(self::$_singleton == null){
			self::$_singleton = new PageService($database);
		}

		return self::$_singleton;
	}

	public function get_pages():array{
		//returns a list of all pages
		echo "this is working";
		return [];
	}

	public function get_page_by_slug(string $slug):?PageModel{
		//this method is a little wonky.  
		//generally, the filtering done in the foreach loop is handled in the SQL query
		//but since this was for demo purposes, I decided to handle it this way.
		//the ?PageModel return type is PHPs say of saying this will return a PageModel or null;

		$pages = $this->_db->get('pages');
		$rawPage = null; 
		foreach($pages as $raw){
			if($raw['slug'] == $slug){
				$rawPage = $raw;
				break;
			}
		}
		
		return ($rawPage != null) ?new PageModel($rawPage) : null;
	}
}