<?php
class ElementsController extends AppController {

	var $name = 'Elements';
	var $helpers = array('Html', 'Form', 'Javascript', 'Ajax');
	var $contentHelpers = false;
	var $uses = null;

	function loginbox()
	{
			
		$this->layout = 'ajax';
			
	}

	function layout()
	{
			
			
	}

}
?>