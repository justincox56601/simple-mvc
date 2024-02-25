<?php
/**
 * DatabaseInterface, establishes that all classes using this interface will need
 * to at least implement a public get function.  normally there would be more.  At
 * least one for each of the CRUD methods.  (Crate, Read, Update, Delete)
 */

interface DatabaseInterface{
	function get(string $query):array;
}