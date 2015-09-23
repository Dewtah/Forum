<?php

Abstract Class baseController {

	function __construct($registry) {
		$this->registry = $registry;
	}


	abstract function index();
}

?>
