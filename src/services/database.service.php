<?php
/**
 * The database sercvice is the only place code should deal directly with the database.
 * It is a singleton to make sure that we don't accidentally make a second point of contact with the database
 * The database service uses the DatabaseInterface so that other classes dependent on this service can be guarnateed
 * that certain methods are available.  This also allows us to swap out the database service if we ever need to change 
 * database systems.
 * 
 * The $_data is our temporary fake database.  It just holds the info we need for now to get data on the screen.  The
 * 'routes'  item is an array of custom defined routes for us to use in our site.  Some sites will defined all of these 
 * ahead of time and only allow users to go to predefined routes.  here is have just defined two different ways to get
 * to the home page.
 * 
 * the pages item is where all of the data for the individual pages is stored.  In a normal website, there would be a 
 * lot more to this, but for now this demonstrates the point.  the key thing you may have not noticed before is the 
 * slug property.  that is the part of the url that this site will read in order to determin which page to display.
 * in the url http://mysite.com/hippo   'hippo'  is the slug.  
 */
require ABS_PATH . '/'. 'src/interfaces/database.interface.php';

class DatabaseService implements DatabaseInterface{
	private static $_singleton;
	private $_data = [
		'routes' =>[
			['route'=>'/', 'controller'=>'page', 'action'=>'index'],
			['route'=>'/index', 'controller'=>'page', 'action'=>'index'],
		],
		'pages' =>[
			['id'=>1, 'slug'=>'hippo', 'title'=>'All About Hippos', 'content'=>'This is my hippo content', 'author'=>'Justin'],
			['id'=>2, 'slug'=>'jaguar', 'title'=>'Check Out These Jaguars', 'content'=>'Jaguars are so cool', 'author'=>'Justin'],
			['id'=>3, 'slug'=>'dog', 'title'=>'Why Dogs Are The Best', 'content'=>'Dogs are the best and if you say otherwise you are wrong.', 'author'=>'Justin'],
			['id'=>3, 'slug'=>'cat', 'title'=>'Why Cats Suck', 'content'=>'My wife is allergic.', 'author'=>'Justin']
		],
	];

	private function __construct(){}

	public static function get_instance():DatabaseService{
		if(self::$_singleton == null){
			self::$_singleton = new DatabaseService();
		}

		return self::$_singleton;
	}

	public function get(string $query):array{
		return $this->_data[$query];
	}
}