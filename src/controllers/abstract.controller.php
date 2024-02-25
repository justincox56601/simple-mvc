<?php
/**
 * Abstract Controller is never meant to be instantiated.  a Controller has no meaning.
 * A PageController or a UserController does have meaning.  This just defines the render
 * method that all controllers will have.
 */

abstract class AbstractController{
	protected function render(string $view, array $data=[]):void{
		extract($data);
		include(ABS_PATH . '/' . "src/views/$view.php");
	}
}