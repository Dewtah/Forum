<?php


Class signoutController Extends baseController {

	public function index() {
		
		unset($_SESSION['user']);
        $this->registry->template->show('signout_index');
	}
}

?>
