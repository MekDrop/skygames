<?php
class Resultdemo extends AppModel {

	var $name = 'Resultdemo';
	var $useTable = 'resultdemos';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Result' => array('className' => 'Result',
								'foreignKey' => 'result_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
								)
								);

}
?>