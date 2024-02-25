<?php
/**
 * The page model is only for taking raw page data from the database and converting it into
 * a useable Page Model.  Any methods that are needed for accessing the Model data is in 
 * here as well
 */

class PageModel{
	private $_title;
	private $_content;
	private $_author;

	function __construct(array $rawPageData){
		$this->_title = $rawPageData['title'];
		$this->_content = $rawPageData['content'];
		$this->_author = $rawPageData['author'];
	}

	public function get_title():string{
		return $this->_title;
	}

	public function get_content():string{
		return $this->_content;
	}

	public function get_author():string{
		return $this->_author;
	}
}