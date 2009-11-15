<?php
class Awardbett extends AppModel {

	var $name = 'Awardbett';
	var $useTable = 'awardbetts';

	var $belongsTo = array(
		'User' => array('className' => 'User',
							'foreignKey' => 'user_id',
							'conditions' => '',
							'fields' => '',
							'order' => ''
							),
						
							
		);
	
	

}
?>